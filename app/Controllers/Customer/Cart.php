<?php
namespace App\Controllers\Customer;
use App\Controllers\BaseController;
use App\Models\ProductModel;

class Cart extends BaseController
{
    public function index()
    {
        $cart = session()->get('cart') ?? [];
        $data['cart'] = $cart;
        return view('customer/cart', $data);
    }

    public function add($id)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) return redirect()->to('/customer/home');

        $cart = session()->get('cart') ?? [];

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id' => $product['product_id'],
                'name' => $product['product_name'],
                'price' => $product['price'],
                'qty' => 1
            ];
        }

        session()->set('cart', $cart);
        return redirect()->to('/customer/cart')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart') ?? [];
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->set('cart', $cart);
        }
        return redirect()->to('/customer/cart');
    }

    public function clear()
    {
        session()->remove('cart');
        return redirect()->to('/customer/cart');
    }
}
