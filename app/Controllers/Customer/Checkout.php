<?php
namespace App\Controllers\Customer;
use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\ProductModel;

class Checkout extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            session()->set('redirect_after_login', '/customer/checkout');
            return redirect()->to('/login')->with('error', 'Silakan login dulu untuk checkout.');
        }

        $cart = session()->get('cart') ?? [];
        if (empty($cart)) return redirect()->to('/customer/cart')->with('error', 'Keranjang kosong.');

        return view('customer/checkout', ['cart' => $cart]);
    }

    public function process()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');
        $cart = session()->get('cart') ?? [];
        if (empty($cart)) return redirect()->to('/customer/cart');

        $user_id = session()->get('user_id');
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart));
        $invoice = 'INV-' . time();

        $transactionModel = new TransactionModel();
        $transactionId = $transactionModel->insert([
            'user_id' => $user_id,
            'invoice_number' => $invoice,
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address' => $this->request->getPost('address'),
        ]);

        // Simpan detail
        $productModel = new ProductModel();
        $db = \Config\Database::connect();
        foreach ($cart as $item) {
            $db->table('transaction_details')->insert([
                'transaction_id' => $transactionId,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty']
            ]);

            // kurangi stok produk
            $productModel->update($item['id'], [
                'stock' => $productModel->find($item['id'])['stock'] - $item['qty']
            ]);
        }

        session()->remove('cart');
        return redirect()->to('/customer/home')->with('success', 'Pesanan berhasil dibuat!');
    }
}
