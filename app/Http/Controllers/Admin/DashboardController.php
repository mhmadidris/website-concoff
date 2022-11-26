<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
  public function index()
  {
    if (Auth::user()->hasRole("admin")) {
      $order = Order::join(
        "transactions",
        "orders.id_transaction",
        "=",
        "transactions.id_transaction"
      )->get();

      $products = Product::all();

      $countCustomer = User::whereHas("roles", function ($q) {
        $q->where("name", "coffeshop");
      })->get();

      $orderData = Order::join(
        "transactions",
        "orders.id_transaction",
        "=",
        "transactions.id_transaction"
      )
        ->join("users", "orders.id_buyer", "=", "users.id")
        ->first();

      return view("pages.dashboard.index")
        ->with("countCustomer", $countCustomer)
        ->with("order", $order)
        ->with("products", $products)
        ->with("orderData", $orderData);
    } elseif (Auth::user()->hasRole("coffeshop")) {
      $authId = Auth::user()->id;
      $order = Order::where("id_buyer", $authId)
        ->join(
          "transactions",
          "orders.id_transaction",
          "=",
          "transactions.id_transaction"
        )
        ->get();

      return view("pages.store.dashboard-user.index")->with("order", $order);
    } else {
      return route("login");
    }
  }
}
