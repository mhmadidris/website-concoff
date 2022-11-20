<?php

namespace App\Http\Livewire\Laporan;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class Laporan extends Component
{
    public $transactions;

    public $dateRange;

    public $startDate = null;

    public $start;
    public $end;

    public $selected_date;
    protected $listeners = ["selectDate" => 'getSelectedDate'];

    public $message = '';

    public $downloadPdf;

    public function mount()
    {


        //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        $this->transactions = Transaction::join('orders', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('users', 'users.id', '=', 'orders.id_buyer')->whereBetween('transactions.date_transaction', [$this->start, $this->end])->get();
    }
    public function render()
    {
        return view('livewire.laporan.laporan')->with('transactions', $this->transactions);
    }

    public function getSelectedDate($date)
    {
        $this->start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $this->end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if ($date != '') {
            $tanggal = explode(' - ', $date);
            $this->start = Carbon::parse($tanggal[0])->format('Y-m-d') . ' 00:00:01';
            $this->end = Carbon::parse($tanggal[1])->format('Y-m-d') . ' 23:59:59';
        }

        $this->transactions = Transaction::join('orders', 'orders.id_transaction', '=', 'transactions.id_transaction')->join('users', 'users.id', '=', 'orders.id_buyer')->whereBetween('transactions.date_transaction', [$this->start, $this->end])->get();

        $this->selected_date = $date;
    }
}
