<?php
namespace App\Models;
use CodeIgniter\Model;

class TransactionDetailModel extends Model
{
    protected $table = 'transaction_details';
    protected $primaryKey = 'detail_id';
    protected $allowedFields = [
        'transaction_id', 'product_id', 'quantity', 'price', 'subtotal'
    ];

    public function getDetailsByTransaction($transaction_id)
    {
        return $this->select('transaction_details.*, products.product_name')
                    ->join('products', 'products.product_id = transaction_details.product_id')
                    ->where('transaction_id', $transaction_id)
                    ->findAll();
    }
}
