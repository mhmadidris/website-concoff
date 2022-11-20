<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\Models\Transaction;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.laporan.index');
    }

    public function create(Request $request)
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');

        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if ($request->dates != '') {
            $tanggal = explode(' - ', $request->dates);
            $start = Carbon::parse($tanggal[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($tanggal[1])->format('Y-m-d') . ' 23:59:59';
        }

        $transactions = Transaction::join('orders', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('users', 'users.id', '=', 'orders.id_buyer')->whereBetween('transactions.date_transaction', [$start, $end])->get();

        return view('pdf.laporan')->with('transactions', $transactions)->with('startDate', $start)->with('endDate', $end);

        // $pdf = PDF::loadview('pdf.laporan', ['transactions' => $transactions, 'startDate' => $start, 'endDate' => $end]);
        // return $pdf->download('invoic.pdf');
    }
}
