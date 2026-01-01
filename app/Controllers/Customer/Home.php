<?php
namespace App\Controllers\Customer;
use App\Controllers\BaseController;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel
            ->where('status', 'active')
            ->orderBy('product_id', 'DESC')
            ->findAll();

        return view('customer/home', $data);
    }
}
