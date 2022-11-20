<?php

namespace App\Http\Livewire\Transaction;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class PushPaymentData extends Component
{
    public $get;

    public $idOrder;

    public $json;

    public $as;

    public function render()
    {
        return view('livewire.transaction.push-payment-data');
    }

    // public function payment_pos(Request $request)
    // {
    //     // $this->json = json_decode($this->json);
    //     // dd($this->json);

    //     // $payment = new Payment();

    //     // $payment->id_order = $request->idOrder;
    //     // $payment->status_code = $json->status_code;
    //     // $payment->status_message = $json->status_message;
    //     // $payment->transaction_id = $json->transaction_id;
    //     // $payment->order_id = $json->order_id;
    //     // $payment->gross_amount = $json->gross_amount;
    //     // $payment->payment_type = $json->payment_type;
    //     // $payment->transaction_time = $json->transaction_time;
    //     // $payment->transaction_status = $json->transaction_status;
    //     // $payment->payment_code = isset($json->payment_code) ? $json->payment_code : null;
    //     // $payment->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;

    //     // if ($payment->save()) {
    //     //     return redirect()->back();
    //     // }
    // }
}
