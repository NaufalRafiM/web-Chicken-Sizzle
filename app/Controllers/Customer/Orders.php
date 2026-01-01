<?php
namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\PaymentModel;

class Orders extends BaseController
{
    protected $txModel;
    protected $detailModel;
    protected $paymentModel;

    public function __construct()
    {
        $this->txModel = new TransactionModel();
        $this->detailModel = new TransactionDetailModel();
        $this->paymentModel = new PaymentModel();
    }

    // List semua transaksi milik user
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            session()->set('redirect_after_login', '/customer/orders');
            return redirect()->to('/login')->with('error', 'Silakan login dulu.');
        }

        $userId = session()->get('user_id');
        $data['orders'] = $this->txModel->getUserTransactions($userId);
        return view('customer/orders/index', $data);
    }

    // Detail satu transaksi (cek kepemilikan user)
    public function detail($id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu.');
        }

        $userId = session()->get('user_id');
        $order = $this->txModel->find($id);
        if (! $order || $order['user_id'] != $userId) {
            return redirect()->to('/customer/orders')->with('error', 'Pesanan tidak ditemukan atau bukan milik Anda.');
        }

        $data['order'] = $order;
        $data['details'] = $this->detailModel->getDetailsByTransaction($id);
        $data['payment'] = $this->paymentModel->where('transaction_id', $id)->first();
        return view('customer/orders/detail', $data);
    }

    // Optional: cancel order jika masih pending
    public function cancel($id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu.');
        }

        $userId = session()->get('user_id');
        $order = $this->txModel->find($id);
        if (! $order || $order['user_id'] != $userId) {
            return redirect()->to('/customer/orders')->with('error', 'Pesanan tidak ditemukan.');
        }

        if (! in_array($order['status'], ['pending'])) {
            return redirect()->to('/customer/orders')->with('error', 'Pesanan tidak dapat dibatalkan (status sudah diproses).');
        }

        $this->txModel->update($id, ['status' => 'cancelled']);
        // optional: restore stock (you can implement if needed)
        return redirect()->to('/customer/orders')->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
