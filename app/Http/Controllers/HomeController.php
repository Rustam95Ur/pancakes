<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller {

    public function index()
    {
        $products = Product::where('status', '=', Product::STATUS_ACTIVE)->orderBy('id', 'DESC')->get();
        return view('home.index', [
            'products'  => $products
        ]);
    }


}
