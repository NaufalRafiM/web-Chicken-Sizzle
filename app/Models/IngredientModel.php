<?php
namespace App\Models;
use CodeIgniter\Model;

class IngredientModel extends Model
{
    protected $table = 'ingredients';
    protected $primaryKey = 'ingredient_id';
    protected $allowedFields = [
        'ingredient_name', 'unit', 'current_stock', 'minimum_stock',
        'price_per_unit', 'status'
    ];

    public function getLowStock()
    {
        return $this->where('current_stock < minimum_stock')
                    ->where('status', 'active')
                    ->findAll();
    }
}
