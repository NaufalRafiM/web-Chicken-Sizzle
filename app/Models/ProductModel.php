<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $allowedFields = [
        'category_id', 'product_name', 'description', 'price',
        'stock', 'image', 'status', 'image' ,'created_at', 'updated_at'
    ];

    // Join kategori biar gampang dipanggil di view
    public function getAllWithCategory()
    {
        return $this->select('products.*, categories.category_name')
                    ->join('categories', 'categories.category_id = products.category_id')
                    ->orderBy('products.product_id', 'DESC')
                    ->findAll();
    }
}
