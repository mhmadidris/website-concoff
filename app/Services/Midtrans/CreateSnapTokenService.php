<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken($id)
    {
        //dd($id);
        //dd($this->order);
        $orderShow = Order::where('kode_order', $id)->where('id_buyer', Auth::user()->id)->join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->join('users', 'orders.id_buyer', '=', 'users.id')->get();

        //dd($orderShow);

        foreach ($orderShow as $key) {
            $transaction_details[] = array(
                'id' => $key->id_product,
                'price' => $key->price,
                'quantity' => $key->jumlah,
                'name' => $key->title,
            );
        }

        $transaction_details[] = array(
            'id' => $key->id_kurir,
            'price' => $key->ongkir,
            'quantity' => 1,
            'name' => 'Ongkir',
        );

        $params = array(
            'transaction_details' => array(
                'order_id' => $this->order->kode_order,
                'gross_amount' => null,
            ),
            'item_details' => $transaction_details,
            // "customer_details" => [
            //     "last_name" => $key->namaPembeli,
            //     "email" => $key->emailPembeli,
            //     "phone" => $key->phonePembeli,
            //     "billing_address" => [
            //         "first_name" => "TEST",
            //         "last_name" => "MIDTRANSER",
            //         "email" => "test@midtrans.com",
            //         "phone" => "081 2233 44-55",
            //         "address" => "Sudirman",
            //         "city" => "Jakarta",
            //         "postal_code" => "12190",
            //         "country_code" => "IDN"
            //     ],
            //     "shipping_address" => [
            //         "first_name" => "TEST",
            //         "last_name" => "MIDTRANSER",
            //         "email" => "test@midtrans.com",
            //         "phone" => "0 8128-75 7-9338",
            //         "address" => "Sudirman",
            //         "city" => "Jakarta",
            //         "postal_code" => "12190",
            //         "country_code" => "IDN"
            //     ]
            // ],
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone_number,
            ),
        );

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
