<?php
namespace App\Models;
use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $allowedFields = [
        'transaction_id', 'payment_method', 'amount', 'status',
        'payment_date', 'proof_image', 'notes', 'verified_at', 'verified_by'
    ];

    public function getAllWithTransaction()
    {
        return $this->select('payments.*, transactions.invoice_number, users.full_name')
                    ->join('transactions', 'transactions.transaction_id = payments.transaction_id')
                    ->join('users', 'users.user_id = transactions.user_id')
                    ->orderBy('payment_date', 'DESC')
                    ->findAll();
    }
}
