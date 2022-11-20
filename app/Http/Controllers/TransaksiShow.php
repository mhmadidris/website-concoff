<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiShow extends Controller
{
    public function show(Request $request, $id)
    {
        if (Auth::user()) {
            if (Auth::user()->hasRole('admin')) {
                $orderShow = Order::join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->where('carts.id_cart', $id)->get();

                return view('pages.detailItems')->with('orderShow', $orderShow);
            } else {
                $orderShow = Order::where('id_buyer', Auth::user()->id)->join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->where('carts.id_cart', $id)->get();

                return view('pages.detailItems')->with('orderShow', $orderShow);
            }
        } else {
            return view('errors.404');
        }
    }
}
