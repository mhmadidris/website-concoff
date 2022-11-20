<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Province;
use Auth;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            // Admin Transaction
            if (Auth::user()->hasRole('admin')) {
                $orderData = Order::join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('users', 'orders.id_buyer', '=', 'users.id')->paginate(5);

                return view('pages.dashboard.transaction.index')->with('orderData', $orderData);
            }
            // Buyer Transaction
            elseif (Auth::user()->hasRole('buyer')) {
                $authId = Auth::user()->id;
                // Get Order Data
                $orderData = Order::where('id_buyer', $authId)->join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('users', 'orders.id_buyer', '=', 'users.id')->paginate(4);

                $orderShow = Order::where('id_buyer', Auth::user()->id)->join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->join('users', 'orders.id_buyer', '=', 'users.id')->get();

                $getCart = Cart::join('products', 'carts.id_product', '=', 'products.id_product')->get();

                return view('pages.store.dashboard-user.transaction.index')->with('orderData', $orderData)->with('getCart', $getCart)->with('orderShow', $orderShow);
            }
        } else {
            return view('errors.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pilihKurir' => 'required',
            'pilihJenisKurir' => 'required',
            'ongkir' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withToastError('Please check your courier or 
            courier package!');
        } else {
            $authId = Auth::user()->id;

            $id_cart = $request->idCart;

            $transaction = new Transaction();

            $transaction->status_transaksi = "Pending";
            $transaction->notes = $request->notes;
            $transaction->id_kurir = $request->pilihKurir;
            $transaction->id_jenisKurir = $request->pilihJenisKurir;
            $transaction->ongkir = $request->ongkir;
            $transaction->totalCost = $request->totalPrice;
            // Convert Durasi
            $getDurasi = $request->durasi;
            $contains = str_contains($getDurasi, '-');
            if ($contains) {
                $conDurasi = strstr($getDurasi, '-', false);
                $resultDurasi = trim($conDurasi, '-');
                $transaction->durasi = $resultDurasi;
            } else {
                $transaction->durasi = $request->durasi + 1;
            }
            $transaction->namaPembeli = $request->namaPembeli;
            $transaction->emailPembeli = $request->emailPembeli;
            $transaction->phonePembeli = $request->nomorPembeli;
            $transaction->date_transaction = Carbon::now();

            if ($transaction->save()) {

                $order = new Order();

                $order->kode_order = "BRJ-" . time() . $authId;
                $order->id_buyer = $authId;
                $order->id_transaction = $transaction->id_transaction;
                $order->date_order = Carbon::now();

                if ($order->save()) {
                    foreach ($id_cart as $key => $value) {
                        Cart::where('id_cart', $value)->update([
                            'id_order' => $order->orderID,
                            'status' => 'Sukses',
                        ]);
                    }
                    if (Auth::user()->hasRole('buyer')) {
                        return redirect()->route('dashboard.transaction.show', $order->kode_order)->withToastSuccess("Let's pay now your order!");
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $passNotif = NotificationController();
        // $passNotif->payment_handler($id);

        if (Auth::user()->hasRole('buyer')) {
            $orderShow = Order::where('kode_order', $id)->where('id_buyer', Auth::user()->id)->join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->join('users', 'orders.id_buyer', '=', 'users.id')->get();

            //$orderGetToken = Order::where('kode_order', $id)->get();
            //dd($orderShow);

            $province = Province::all();

            $city = City::all();

            $payment = Payment::all();

            $getPay = Order::where('kode_order', $id)->get();

            foreach ($getPay as $keyPay) {
                $order = $keyPay;
                //dd($order);
            }

            $snapToken = $order->snap_token;

            if (is_null($snapToken)) {
                $midtrans = new CreateSnapTokenService($order);
                $snapToken = $midtrans->getSnapToken($id);

                $order->snap_token = $snapToken;
                $order->save();
            }

            return view('pages.store.dashboard-user.transaction.detail')->with('orderShow', $orderShow)->with('snap_token', $snapToken)->with('province', $province)->with('city', $city)->with('payment', $payment)->with('payment', $payment);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()) {
            if (Auth::user()->hasRole('admin')) {
                $orderShow = Order::where('orders.kode_order', $id)->join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->join('users', 'orders.id_buyer', '=', 'users.id')->get();

                $province = Province::all();

                $city = City::all();

                //dd($orderShow);

                return view('pages.dashboard.transaction.edit')->with('orderShow', $orderShow)->with('province', $province)->with('city', $city);
            } else {
                return redirect()->back();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Date Convertion
        $dayExtraTime = $request->durasi + 1;
        $daySeconds = time() + 86400 * $dayExtraTime;
        $convertDay = $daySeconds;
        $resultDate = date('Y-m-d H:i:s', $convertDay);

        $upTransaksi = Transaction::find($id);

        $upTransaksi->date_start = Carbon::now();
        $upTransaksi->date_end = $resultDate;
        $upTransaksi->status_transaksi = 'Sedang Dikirim';
        $upTransaksi->nomorResi = $request->nomorResi;

        $upTransaksi->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payment_pos(Request $request)
    {
        $json = json_decode($request->json);
        //dd($json);

        $payment = new Payment();

        $payment->id_order = $request->idOrder;
        $payment->status_code = $json->status_code;
        $payment->status_message = $json->status_message;
        $payment->transaction_id = $json->transaction_id;
        $payment->order_id = $json->order_id;
        $payment->gross_amount = $json->gross_amount;
        $payment->payment_type = $json->payment_type;
        $payment->transaction_time = $json->transaction_time;
        $payment->transaction_status = $json->transaction_status;
        $payment->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $payment->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;

        if ($payment->save()) {
            return redirect()->back();
        }
    }

    public function success(Request $request)
    {
        $idTransaction = $request->id_sukses;

        $upTran = Transaction::find($idTransaction);

        $upTran->status_transaksi = 'Success';

        if ($upTran->save()) {
            return redirect()->back()->withToastSuccess('Congrats your package has arrived!');
        }
    }

    public function convertPDF($id)
    {
        $transaksipdf = Order::where('kode_order', $id)->join('transactions', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('carts', 'orders.orderID', '=', 'carts.id_order')->join('products', 'carts.id_product', '=', 'products.id_product')->join('users', 'orders.id_buyer', '=', 'users.id')->get();

        $userProv = Province::all();

        $userCity = City::all();

        $admin = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'admin');
            }
        )->get();

        return view('pdf.transaction')->with('transaksipdf', $transaksipdf)->with('userProv', $userProv)->with('userCity', $userCity)->with('admin', $admin);

        // $pdf = PDF::loadview('pdf.transaction', ['transaksipdf' => $transaksipdf, 'admin' => $admin, 'userProv' => $userProv, 'userCity' => $userCity]);
        // return $pdf->download('invoice ' . $id . '.pdf');
    }
}
