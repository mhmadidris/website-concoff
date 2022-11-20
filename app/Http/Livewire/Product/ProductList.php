<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductList extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.product.product-list', [
            'products' => Product::where(function ($sub_query) {
                $sub_query->where('title', 'like', '%' . $this->search . '%');
            })->paginate(10)
        ]);
    }
}
