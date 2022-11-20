<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->hasRole('buyer')) {
                if (Auth::user()->id_province != null && Auth::user()->id_city != null && Auth::user()->detail_address != null && Auth::user()->zipcode != null) {

                    $authId = Auth::user()->id;
                    $cartList = Cart::join('users', 'carts.id_user', '=', 'users.id')->join('products', 'carts.id_product', '=', 'products.id_product')->where('id_user', $authId)->where('status', 'Cart')->get();

                    return view('pages.store.cart')->with('carts', $cartList);
                } else {
                    return redirect()->route('dashboard.profile.edit', Auth::user()->id)->withToastWarning('Please complete your profile');
                }
            } else {
                return redirect()->back();
            }
        } else {
            return route('login');
        }
    }

    public function store(Request $request)
    {
        $idUser = Auth::user()->id;

        $productExist = Cart::where('id_user', $idUser)->where('id_user', Auth::user()->id)->where('id_product', $request->idProduct)->where('pilihanSelected', $request->pilihanSelected)->where('sizeSelected', $request->sizeSelected)->first();

        // Record Exists
        if ($productExist != null) {
            $cartExists = Cart::where('id_cart', $productExist->id_cart)->update([
                'id_user' => $idUser,
                'status' => "Cart",
                'id_product' => $request->idProduct,
                'jumlah' => $productExist->jumlah + $request->jumlah,
                'pilihanSelected' => $request->pilihanSelected,
                'sizeSelected' => $request->sizeSelected,
            ]);

            if ($cartExists) {
                return redirect()->back()->withToastSuccess('Product successfully add to cart!');
            } else {
                return redirect()->back()->withToastError('Product failed add to cart!');
            }
        } else {
            $cart = new Cart();

            $cart->id_user = $idUser;
            $cart->status = "Cart";
            $cart->id_product = $request->idProduct;
            $cart->jumlah = $request->jumlah;
            $cart->pilihanSelected = $request->pilihanSelected;
            $cart->sizeSelected = $request->sizeSelected;

            if ($cart->save()) {
                return redirect()->back()->withToastSuccess('Product successfully add to cart!');
            } else {
                return redirect()->back()->withToastError('Product failed add to cart!');
            }
        }
    }

    public function show()
    {
    }

    public function destroy($id)
    {
        $this->cartDelete = Cart::where('id_cart', $id);

        if ($this->cartDelete->delete()) {
            return redirect()->back()->withToastSuccess('Product Successfully deleted!');
        } else {
            return redirect()->back()->withToastSuccess('Product Failed deleted!');
        }
    }
}
