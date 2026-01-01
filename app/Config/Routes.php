<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Halaman Publik
$routes->get('about', 'PublicPages::about');
$routes->get('contact', 'PublicPages::contact');
$routes->get('faq', 'PublicPages::faq');
$routes->get('terms', 'PublicPages::terms');
$routes->get('privacy', 'PublicPages::privacy');
$routes->get('testimonials', 'PublicPages::testimonials');
$routes->get('blog', 'PublicPages::blog');
$routes->get('promo', 'PublicPages::promo');


$routes->group('admin', function($routes) {
    // CRUD Produk (baru)
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->post('products/store', 'Admin\Products::store');
    $routes->get('products/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Products::update/$1');
    $routes->get('products/delete/(:num)', 'Admin\Products::delete/$1');

    // CRUD Kategori (baru)
    $routes->get('categories', 'Admin\Categories::index');
    $routes->get('categories/create', 'Admin\Categories::create');
    $routes->post('categories/store', 'Admin\Categories::store');
    $routes->get('categories/edit/(:num)', 'Admin\Categories::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\Categories::update/$1');
    $routes->get('categories/delete/(:num)', 'Admin\Categories::delete/$1');

});

$routes->get('/login', 'Auth\Login::index');
$routes->post('/login/process', 'Auth\Login::process');
$routes->get('/logout', 'Auth\Login::logout');
$routes->get('/register', 'Auth\Register::index');
$routes->post('/register/store', 'Auth\Register::store');

$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
        $routes->get('dashboard', 'Admin\Dashboard::index');
        $routes->get('products', 'Admin\Products::index');
        $routes->get('categories', 'Admin\Categories::index');
        $routes->get('orders', 'Admin\Orders::index');
        $routes->get('orders/detail/(:num)', 'Admin\Orders::detail/$1');
        $routes->post('orders/updateStatus/(:num)', 'Admin\Orders::updateStatus/$1');
        $routes->get('payments', 'Admin\Payments::index');
        $routes->get('payments/verify/(:num)', 'Admin\Payments::verify/$1');
        $routes->post('payments/processVerification/(:num)', 'Admin\Payments::processVerification/$1');
        $routes->get('reports', 'Admin\Reports::index');
        $routes->get('reports/exportPdf', 'Admin\Reports::exportPdf');
        $routes->get('reports/exportExcel', 'Admin\Reports::exportExcel');
        
        $routes->get('inventory', 'Admin\Inventory::index');
        $routes->get('inventory/form', 'Admin\Inventory::form'); 
        $routes->get('inventory/add', 'Admin\Inventory::addIngredient');
        $routes->post('inventory/add', 'Admin\Inventory::addIngredient');
        $routes->match(['get', 'post'], 'inventory/form/(:num)', 'Admin\Inventory::form/$1');
        $routes->get('inventory/delete/(:num)', 'Admin\Inventory::delete/$1');
        $routes->get('inventory/history/(:num)', 'Admin\Inventory::history/$1');
});

$routes->group('customer', ['filter' => 'auth'], function($routes) {
    
    $routes->get('home', 'Customer\Home::index');
    $routes->get('cart', 'Customer\Cart::index');
    $routes->get('cart/add/(:num)', 'Customer\Cart::add/$1');
    $routes->get('cart/remove/(:num)', 'Customer\Cart::remove/$1');
    $routes->get('cart/clear', 'Customer\Cart::clear');

    $routes->get('checkout', 'Customer\Checkout::index');
    $routes->post('checkout/process', 'Customer\Checkout::process');

    $routes->get('wishlist', 'Customer\Wishlist::index');
    $routes->get('wishlist/toggle/(:num)', 'Customer\Wishlist::toggle/$1');

    $routes->get('account/profile', 'Customer\Account::profile');
    $routes->post('account/update-profile', 'Customer\Account::updateProfile');
    $routes->get('account/change-password', 'Customer\Account::changePassword');
    $routes->post('account/update-password', 'Customer\Account::updatePassword');
    $routes->get('account/notifications', 'Customer\Account::notifications');
    $routes->post('account/update-notifications', 'Customer\Account::updateNotifications');

    $routes->get('payment', 'Customer\Payment::index');
    $routes->post('payment/process', 'Customer\Payment::process');
    $routes->get('payment/invoice/(:num)', 'Customer\Payment::invoice/$1');
    $routes->post('payment/uploadProof/(:num)', 'Customer\Payment::uploadProof/$1');

    $routes->get('orders', 'Customer\Orders::index');
    $routes->get('orders/detail/(:num)', 'Customer\Orders::detail/$1');
    $routes->get('orders/cancel/(:num)', 'Customer\Orders::cancel/$1');

    $routes->get('orders', 'Customer\Orders::index');
    $routes->get('orders/detail/(:num)', 'Customer\Orders::detail/$1');
    $routes->get('orders/cancel/(:num)', 'Customer\Orders::cancel/$1');
});