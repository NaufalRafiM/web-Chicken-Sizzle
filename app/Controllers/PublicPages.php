<?php
namespace App\Controllers;

class PublicPages extends BaseController
{
    public function about()
    {
        return view('public/about');
    }

    public function contact()
    {
        return view('public/contact');
    }

    public function faq()
    {
        return view('public/faq');
    }

    public function terms()
    {
        return view('public/terms');
    }

    public function privacy()
    {
        return view('public/privacy');
    }

    public function testimonials()
    {
        return view('public/testimonials');
    }

    public function blog()
    {
        return view('public/blog');
    }

    public function promo()
    {
        return view('public/promo');
    }
}
