<?php
namespace App\Controllers;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel
            ->where('status', 'active')
            ->orderBy('product_id', 'DESC')
            ->limit(4)
            ->findAll();

        return view('public/index', $data);
    }
}
