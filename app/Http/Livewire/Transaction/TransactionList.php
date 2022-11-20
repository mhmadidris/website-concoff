<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;

class TransactionList extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.transaction.transaction-list', [
            'products' => Product::where(function ($sub_query) {
                $sub_query->where('title', 'like', '%' . $this->search . '%');
            })->paginate(10)
        ]);
    }
}
