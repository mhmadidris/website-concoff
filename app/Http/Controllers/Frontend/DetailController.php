<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;

class DetailController extends Controller
{
    public function index()
    {
        return view('pages.detail');
    }

    public function show($id)
    {
        $count = Product::count();

        $data = Product::where('id_product', $id)->get();

        $dataAll = Product::all();

        if (Auth::user()) {
            if (Auth::user()->hasRole('admin')) {
                return view('pages.detail')->with('count', $count)->with('data', $data)->with('dataAll', $dataAll);
            } elseif (Auth::user()->hasRole('buyer')) {
                return view('pages.store.detail')->with('count', $count)->with('data', $data)->with('dataAll', $dataAll);
            }
        } else {
            return view('pages.store.detail')->with('count', $count)->with('data', $data)->with('dataAll', $dataAll);
        }
    }
}
