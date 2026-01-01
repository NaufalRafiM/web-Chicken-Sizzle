<?php
namespace App\Models;
use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'wishlist_id';
    protected $allowedFields = ['user_id','product_id','created_at'];

    public function isSaved($user_id, $product_id)
    {
        return (bool) $this->where('user_id', $user_id)
                           ->where('product_id', $product_id)
                           ->first();
    }

    public function getByUser($user_id)
    {
        return $this->select('wishlist.*, products.product_name, products.price, products.image, products.status')
                    ->join('products','products.product_id = wishlist.product_id')
                    ->where('wishlist.user_id', $user_id)
                    ->orderBy('wishlist.created_at','DESC')
                    ->findAll();
    }

    public function removeItem($user_id, $product_id)
    {
        return $this->where('user_id', $user_id)->where('product_id', $product_id)->delete();
    }
}
