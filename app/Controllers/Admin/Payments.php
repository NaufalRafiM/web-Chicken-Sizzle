<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\TransactionModel;

class Payments extends BaseController
{
    public function index()
    {
        $paymentModel = new PaymentModel();
        $data['payments'] = $paymentModel->getAllWithTransaction();
        return view('admin/payments/index', $data);
    }

    public function verify($id)
    {
        $paymentModel = new PaymentModel();
        $transactionModel = new TransactionModel();

        $data['payment'] = $paymentModel
            ->select('payments.*, transactions.invoice_number, users.full_name, users.email, users.phone')
            ->join('transactions', 'transactions.transaction_id = payments.transaction_id')
            ->join('users', 'users.user_id = transactions.user_id')
            ->where('payments.payment_id', $id)
            ->first();

        if (!$data['payment']) {
            return redirect()->to('/admin/payments')->with('error', 'Data pembayaran tidak ditemukan.');
        }

        return view('admin/payments/verify', $data);
    }

    public function processVerification($id)
    {
        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('notes');

        $paymentModel = new PaymentModel();
        $transactionModel = new TransactionModel();

        $payment = $paymentModel->find($id);

        if (!$payment) {
            return redirect()->to('/admin/payments')->with('error', 'Pembayaran tidak ditemukan.');
        }

        $paymentModel->update($id, [
            'status' => $status,
            'notes' => $notes,
            'verified_at' => date('Y-m-d H:i:s'),
            'verified_by' => session()->get('user_id')
        ]);

        // Kalau pembayaran diverifikasi → ubah status transaksi jadi 'paid'
        if ($status === 'verified') {
            $transactionModel->update($payment['transaction_id'], ['status' => 'paid']);
        }

        return redirect()->to('/admin/payments')->with('success', 'Pembayaran berhasil diverifikasi!');
    }
}
