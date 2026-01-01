<?php
namespace App\Controllers\Customer;
use App\Controllers\BaseController;
use App\Models\WishlistModel;
use App\Models\ProductModel;

class Wishlist extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');

        // If logged in: fetch from DB. Else: fetch from session.
        if ($user_id) {
            $model = new WishlistModel();
            $data['items'] = $model->getByUser($user_id);
        } else {
            $cart = $session->get('wishlist') ?? [];
            // cart structure: [product_id => ['id'=>..., 'name'=>..., 'price'=>..., 'image'=>...]]
            $data['items'] = array_values($cart);
        }

        return view('customer/wishlist', $data);
    }

    // Toggle add/remove wishlist (GET or POST)
    public function toggle($product_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        $productModel = new ProductModel();
        $product = $productModel->find($product_id);
        if (!$product) return redirect()->back()->with('error','Produk tidak ditemukan.');

        // jika user logged in -> simpan di DB
        if ($user_id) {
            $model = new WishlistModel();
            if ($model->isSaved($user_id, $product_id)) {
                $model->removeItem($user_id, $product_id);
                return redirect()->back()->with('success','Produk dihapus dari wishlist.');
            } else {
                $model->insert(['user_id'=>$user_id, 'product_id'=>$product_id]);
                return redirect()->back()->with('success','Produk disimpan ke wishlist.');
            }
        }

        // guest -> simpan di session
        $wishlist = $session->get('wishlist') ?? [];
        if (isset($wishlist[$product_id])) {
            unset($wishlist[$product_id]);
            $session->set('wishlist', $wishlist);
            return redirect()->back()->with('success','Produk dihapus dari wishlist (session).');
        } else {
            $wishlist[$product_id] = [
                'id'=> $product['product_id'],
                'name'=> $product['product_name'],
                'price'=> $product['price'],
                'image'=> $product['image'] ?? null
            ];
            $session->set('wishlist', $wishlist);
            return redirect()->back()->with('success','Produk disimpan ke wishlist (session).');
        }
    }

    // Optional: fungsi merge session wishlist saat user login
    public function mergeSessionToDb($user_id)
    {
        $session = session();
        $wishlist = $session->get('wishlist') ?? [];
        if (!$user_id || empty($wishlist)) return;

        $model = new WishlistModel();
        foreach ($wishlist as $pid => $item) {
            if (!$model->isSaved($user_id, $pid)) {
                $model->insert(['user_id'=>$user_id,'product_id'=>$pid]);
            }
        }
        $session->remove('wishlist');
    }
}
