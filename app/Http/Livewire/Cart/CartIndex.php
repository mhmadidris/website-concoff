<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Livewire\Component;

class CartIndex extends Component
{
    public $authId, $carts;

    public $cost;
    public $pilihHarga;

    public $goals;
    public $goal;

    public $pilihKurir;
    public $jenisKurir;
    public $ongkirResult;
    public $hargaOngkir;

    public function mount()
    {

        // dd($this->alamatKantor);
        // $this->alamatKantorId = $this->alamatKantor;

        $this->cost = RajaOngkir::ongkosKirim([
            'origin' => 255,
            'originType' => "city",
            'destination' => 398,
            'destinationType' => "city",
            'weight' => 1300,
            'courier' => 'jne:pos:tiki',
        ])->get();

        $this->pilihHarga = $this->pilihKurir;

        // $json = json_decode($this->cost, true);

        //dd($this->cost);

    }

    public function render()
    {
        $this->authId = Auth::user()->id;
        $this->carts = Cart::where('id_user', $this->authId)->join('users', 'carts.id_user', '=', 'users.id')->join('products', 'carts.id_product', '=', 'products.id_product')->get();

        // $this->result = $this->carts->get('jumlah');

        return view('livewire.cart.cart-index');
    }

    public function changeEvent($value)
    {
        $this->pilihKurir = $value;

        $this->jenisKurir = $p;

        $this->ongkirResult = $harga;

    }
}
