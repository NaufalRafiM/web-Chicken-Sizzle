<?php
namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\ProductModel;
use App\Models\PaymentModel;

class Payment extends BaseController
{
    protected $transactionModel;
    protected $productModel;
    protected $paymentModel;
    protected $detailModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->productModel = new ProductModel();
        $this->paymentModel = new PaymentModel();
        $this->detailModel = new TransactionDetailModel();
    }

    /**
     * Show payment page after checkout summary (or as step in checkout)
     * expects cart in session or transaction id via GET
     */
    public function index()
    {
        // must be logged in before payment (checkout flow ensures that)
        if (! session()->get('isLoggedIn')) {
            session()->set('redirect_after_login', current_url());
            return redirect()->to('/login')->with('error','Silakan login dulu untuk lanjut pembayaran.');
        }

        // ambil cart dari session (atau load transaction draft)
        $cart = session()->get('cart') ?? [];
        if (empty($cart)) {
            return redirect()->to('/customer/cart')->with('error','Keranjang kosong.');
        }

        // hitung subtotal & total
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        // default shipping cost calculation will be handled client-side & validated server-side
        $data = [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'user' => $this->getUserData(), // helper method below
            // payment info static (contoh bank)
            'payment_info' => [
                'bank' => 'BCA',
                'account_name' => 'ChickenSizzle',
                'account_number' => '1234567890',
                'note' => 'Transfer ke rekening di atas. Upload bukti pembayaran setelah transfer.'
            ],
            // service area config (could be moved to config file)
            'service_area' => $this->getServiceAreaConfig()
        ];

        return view('customer/payment/index', $data);
    }

    /**
     * Process payment: create transaction + payment record (if immediate)
     */
    public function process()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error','Silakan login dulu.');
        }

        $post = $this->request->getPost();
        $cart = session()->get('cart') ?? [];
        if (empty($cart)) return redirect()->to('/customer/cart')->with('error','Keranjang kosong.');

        // basic posted fields
        $shipping_method = $post['shipping_method'] ?? 'pickup'; // delivery|pickup|cod|thirdparty
        $shipping_address = $post['shipping_address'] ?? session()->get('address') ?? '';
        $shipping_cost = (float) ($post['shipping_cost'] ?? 0);
        $payment_method = $post['payment_method'] ?? 'transfer'; // transfer|cash|ewallet
        $notes = $post['notes'] ?? null;

        // validate shipping availability for delivery / cod
        if (in_array($shipping_method, ['delivery','cod'])) {
            if (! $this->isWithinServiceArea($shipping_address)) {
                // blocked: not in service area -> recommend thirdparty
                return redirect()->back()->with('error','Maaf, delivery/COD hanya tersedia di area layanan kami. Silakan pilih pickup atau gunakan link GoFood/partner.');
            }
        }

        // calculate totals
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        $total = $subtotal + $shipping_cost;

        // prepare transaction insert
        $invoice = 'INV-' . time() . '-' . rand(100,999);
        $transactionData = [
            'user_id' => session()->get('user_id'),
            'invoice_number' => $invoice,
            'total_amount' => $total,
            'status' => ($payment_method === 'cash' && $shipping_method === 'cod') ? 'paid' : 'pending',
            'shipping_address' => $shipping_address,
            'shipping_method' => $shipping_method,
            'shipping_cost' => $shipping_cost,
            'notes' => $notes,
        ];

        $txId = $this->transactionModel->insert($transactionData);

        // insert transaction_details & update product stock
        foreach ($cart as $item) {
            $this->detailModel->insert([
                'transaction_id' => $txId,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty']
            ]);

            // reduce stock
            $product = $this->productModel->find($item['id']);
            $newStock = max(0, $product['stock'] - $item['qty']);
            $this->productModel->update($item['id'], ['stock' => $newStock]);
        }

        // create payment record (if transfer/ewallet requires proof)
        if ($payment_method === 'transfer' || $payment_method === 'ewallet') {
            $this->paymentModel->insert([
                'transaction_id' => $txId,
                'payment_method' => $payment_method === 'transfer' ? 'transfer' : 'ewallet',
                'amount' => $total,
                'status' => 'pending',
                'payment_date' => null,
                'notes' => 'Menunggu bukti pembayaran'
            ]);

            // clear cart and redirect to upload proof page or invoice page
            session()->remove('cart');
            return redirect()->to("/customer/payment/invoice/{$txId}")->with('success','Transaksi dibuat. Silakan unggah bukti transfer untuk verifikasi.');
        }

        // cash / cod / pickup => mark appropriate statuses
        if ($payment_method === 'cash' && $shipping_method === 'cod') {
            // COD paid on delivery but we mark transaction as pending -> or 'paid' depending on policy
            // set as pending for admin confirmation or 'processing'
            $this->transactionModel->update($txId, ['status' => 'processing']);
        }

        // create a payment record for cash with status 'pending' (optional)
        $this->paymentModel->insert([
            'transaction_id' => $txId,
            'payment_method' => ($payment_method === 'cash' ? 'cash' : $payment_method),
            'amount' => $total,
            'status' => ($payment_method === 'cash' && $shipping_method === 'cod') ? 'pending' : 'pending',
            'payment_date' => date('Y-m-d H:i:s'),
            'notes' => $notes
        ]);

        session()->remove('cart');
        return redirect()->to('/customer/orders')->with('success','Pesanan berhasil dibuat! Cek riwayat pesanan untuk info lebih lanjut.');
    }

    /**
     * Invoice / detail page after creating transaction (for uploading proof)
     */
    public function invoice($txId)
    {
        $tx = $this->transactionModel->find($txId);
        if (!$tx || $tx['user_id'] != session()->get('user_id')) {
            return redirect()->to('/customer/orders')->with('error','Transaksi tidak ditemukan.');
        }
        $details = $this->detailModel->getDetailsByTransaction($txId);
        $payment = $this->paymentModel->where('transaction_id', $txId)->first();
        $data = compact('tx', 'details', 'payment');
        return view('customer/payment/invoice', $data);
    }

    /**
     * Upload proof for transfer/ewallet
     */
    public function uploadProof($paymentId)
    {
        $file = $this->request->getFile('proof_image');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error','Bukti pembayaran belum dipilih.');
        }

        // basic checks
        if (! in_array($file->getMimeType(), ['image/jpeg','image/png','image/webp'])) {
            return redirect()->back()->with('error','Format gambar tidak didukung.');
        }

        $name = $file->getRandomName();
        $file->move(FCPATH . 'uploads', $name);
        $this->paymentModel->update($paymentId, [
            'proof_image' => $name,
            'payment_date' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success','Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }

    // -------------------------
    // Helper functions
    // -------------------------
    private function getUserData()
    {
        $uid = session()->get('user_id');
        if (!$uid) return null;
        return (new \App\Models\UserModel())->find($uid);
    }

    /**
     * service area configuration (simple)
     * return array of allowed city names / postal prefixes
     */
    private function getServiceAreaConfig()
    {
        // ideally move to app/Config/ServiceArea.php or .env
        return [
            'cities' => ['Jakarta','Depok','Bekasi','Tangerang'], // contoh
            'postal_prefixes' => ['10','11','12','13','16'] // prefix kode pos (opsional)
        ];
    }

    /**
     * Simple check: apakah alamat termasuk area layanan?
     * Implementation: cek apakah city substring ada dalam address OR postal prefix matches.
     */
    private function isWithinServiceArea($address)
    {
        $cfg = $this->getServiceAreaConfig();
        $addrLower = strtolower($address ?: '');
        foreach ($cfg['cities'] as $city) {
            if (strpos($addrLower, strtolower($city)) !== false) return true;
        }
        // check postcode prefix if present in address (very naive)
        foreach ($cfg['postal_prefixes'] as $prefix) {
            if (strpos($address, $prefix) !== false) return true;
        }
        return false;
    }
}
