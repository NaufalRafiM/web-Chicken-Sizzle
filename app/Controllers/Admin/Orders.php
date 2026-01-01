<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\UserModel;

class Orders extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();
        $data['orders'] = $transactionModel->getAllTransactions();
        return view('admin/orders/index', $data);
    }

    public function detail($id)
    {
        $transactionModel = new TransactionModel();
        $detailModel = new TransactionDetailModel();

        $data['order'] = $transactionModel->find($id);
        $data['details'] = $detailModel->getDetailsByTransaction($id);
        return view('admin/orders/detail', $data);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        $transactionModel = new TransactionModel();
        $transactionModel->updateStatus($id, $status);
        return redirect()->to('/admin/orders')->with('success', 'Status pesanan diperbarui!');
    }
}
