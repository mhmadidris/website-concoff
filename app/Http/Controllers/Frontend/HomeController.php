<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        // Article
        $articleList = Article::all();

        // Product List
        $productList = Product::where('unggulan', '=', '1')->get();


        return view('pages.store.index')->with('products', $productList)->with('articles', $articleList);
    }

    public function allProduct()
    {
        $products = Product::all();
        return view('pages.store.product')->with('products', $products);
    }
}
