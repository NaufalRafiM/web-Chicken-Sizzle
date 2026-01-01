<?php
namespace App\Models;
use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $allowedFields = ['user_id', 'product_id', 'quantity', 'added_at'];

    /**
     * Ambil semua item keranjang user
     */
    public function getCartByUser($user_id)
    {
        return $this->select('carts.*, products.product_name, products.price, products.image')
                    ->join('products', 'products.product_id = carts.product_id')
                    ->where('carts.user_id', $user_id)
                    ->findAll();
    }

    /**
     * Hapus semua cart user
     */
    public function clearCart($user_id)
    {
        return $this->where('user_id', $user_id)->delete();
    }

    /**
     * Tambah produk ke cart user
     */
    public function addToCart($user_id, $product_id, $qty = 1)
    {
        $cart = $this->where('user_id', $user_id)
                     ->where('product_id', $product_id)
                     ->first();

        if ($cart) {
            $this->update($cart['cart_id'], [
                'quantity' => $cart['quantity'] + $qty
            ]);
        } else {
            $this->insert([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $qty
            ]);
        }
    }
}
