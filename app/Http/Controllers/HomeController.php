<?php

namespace App\Http\Controllers;

use App\Models\Product;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Page;

class HomeController extends Controller {
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::where('status', '=', Product::STATUS_ACTIVE)->orderBy('id', 'DESC')->get();
        return view('home.index', [
            'products'  => $products
        ]);
    }

    public function page($slug)
    {
        $page = Page::where('slug', '=', $slug)->where('status', '=', Page::STATUS_ACTIVE)->firstOrFail();
        return view('home.page', [
            'page'  => $page
        ]);
    }

    public function menu($slug)
    {
        $categories = Category::all();
        $pancake = Category::where('slug', '=', $slug)->firstOrFail();
        $products = Product::where('category_id', '=', $pancake->id)->get();
        return view('home.menu', [
            'categories' => $categories,
            'products' => $products,
            'slug'  => $slug
        ]);
    }

    public function contact()
    {
        return view('home.contact', [

        ]);
    }




}
