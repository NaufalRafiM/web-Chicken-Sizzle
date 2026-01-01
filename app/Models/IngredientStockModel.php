<?php
namespace App\Models;
use CodeIgniter\Model;

class IngredientStockModel extends Model
{
    protected $table = 'ingredient_stock';
    protected $primaryKey = 'stock_id';
    protected $allowedFields = [
        'ingredient_id', 'supplier_id', 'transaction_type',
        'quantity', 'price', 'transaction_date', 'notes', 'created_by'
    ];

    public function getHistory($ingredient_id)
    {
        return $this->select('ingredient_stock.*, users.username')
                    ->join('users', 'users.user_id = ingredient_stock.created_by', 'left')
                    ->where('ingredient_id', $ingredient_id)
                    ->orderBy('transaction_date', 'DESC')
                    ->findAll();
    }
}
