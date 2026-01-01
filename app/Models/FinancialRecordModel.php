<?php
namespace App\Models;
use CodeIgniter\Model;

class FinancialRecordModel extends Model
{
    protected $table = 'financial_records';
    protected $primaryKey = 'record_id';
    protected $allowedFields = [
        'transaction_type', 'amount', 'category',
        'description', 'transaction_date',
        'reference_id', 'reference_type', 'created_by'
    ];
}
