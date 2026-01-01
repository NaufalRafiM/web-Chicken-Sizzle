<?php
namespace App\Models;
use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $allowedFields = [
        'user_id',
        'invoice_number',
        'transaction_date',
        'total_amount',
        'status',
        'shipping_address',
        'notes'
    ];

    /**
     * Ambil semua transaksi (buat admin)
     */
    public function getAllTransactions()
    {
        return $this->select('transactions.*, users.full_name, users.email')
                    ->join('users', 'users.user_id = transactions.user_id')
                    ->orderBy('transactions.transaction_date', 'DESC')
                    ->findAll();
    }

    /**
     * Ambil transaksi berdasarkan user (buat customer)
     */
    public function getUserTransactions($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('transaction_date', 'DESC')
                    ->findAll();
    }

    /**
     * Ambil detail transaksi + produk
     */
    public function getTransactionDetails($transaction_id)
    {
        return $this->db->table('transaction_details')
                        ->select('transaction_details.*, products.product_name')
                        ->join('products', 'products.product_id = transaction_details.product_id')
                        ->where('transaction_id', $transaction_id)
                        ->get()->getResultArray();
    }

    /**
     * Update status transaksi
     */
    public function updateStatus($transaction_id, $status)
    {
        return $this->update($transaction_id, ['status' => $status]);
    }
}
