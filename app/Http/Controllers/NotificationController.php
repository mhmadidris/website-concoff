<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class NotificationController extends Controller
{
    public function payment_handler(Request $request)
    {
        // return $id;
        $payment = Payment::all();

        $json = json_decode($request->getContent());

        $signatur_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));
        //return $signatur_key;

        $orderShow = Order::where('kode_order', $json->order_id)->join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->join('users', 'orders.id_buyer', '=', 'users.id')->get();
        //return $orderShow;

        if ($signatur_key == $json->signature_key) {
            $payment = Payment::where('order_id', $json->order_id)->first();

            $payment->status_message = $json->status_message;
            $payment->status_code = $json->status_code;
            $payment->transaction_status = $json->transaction_status;

            $payment->save();
            
            if ($payment->save()) {
                // Settlement // Capture
                if ($payment->transaction_status == 'settlement' || $payment->transaction_status == 'capture') {
                    foreach ($orderShow as $key) {
                        // Update Stock
                        $getIdProduct = $key->id_product; // Get Id Product
                        $upProduct = Product::findOrFail($getIdProduct);
                        $upProduct->stock = $key->stock - $key->jumlah;
                        $upProduct->save();
                    }

                    $upTransaksi = Transaction::findOrFai($key->id_transaction);

                    $upTransaksi->status_transaksi = 'Waiting';

                    $upTransaksi->save();
                    return redirect()->back()->withToastSuccess('Congrats your payment has been received!');
                }
                // Cancel
                elseif ($payment->transaction_status == 'cancel') {
                    foreach ($orderShow as $key) {
                        $upCancel = $key;
                    }


                    $upTransaksi = Transaction::findOrFail($upCancel->id_transaction);

                    $upTransaksi->status_transaksi = 'Canceled';

                    $upTransaksi->save();
                    return redirect()->back()->withToastWarning('Your payment has been canceled!');
                }
                // Expire
                else {
                    foreach ($orderShow as $key) {
                        $upExpire = $key;
                    }

                    $upTransaksi = Transaction::findOrFail($upExpire->id_transaction);

                    $upTransaksi->status_transaksi = 'Expired';

                    $upTransaksi->save();
                    return redirect()->back()->withToastError('Your payment has been expired!');
                }
            }
        } else {
            return abort(404);
        }
    }
}
