<?php

namespace App\Http\Livewire\Cart;

use App\Models\Cart;
use App\Models\User;
use Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Livewire\Component;

class Calculate extends Component
{
    // Raja Ongkir
    public $pilihKurir, $jenisKurir, $hargaOngkir, $cartsPrice;

    // Get Alamat Admin
    public $adminAlamat, $getAlamatKantor;

    // Get Alamat Buyer
    public $authBuyer, $alamatBuyer, $getAlamatBuyer;

    // Get Weight
    public $getWeight;

    public function mount()
    {
        // Cart List
        $this->auth = Auth::user()->id;
        $this->cart = Cart::join('users', 'users.id', '=', 'carts.id_user')
            ->join('products', 'products.id_product', '=', 'carts.id_product')
            ->get();

        // Get Alamat Admin
        $this->adminAlamat = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->get();
        foreach ($this->adminAlamat as $key => $value) {
            $this->getAlamatKantor = $value->id_city;
        }

        // Get Alamat Buyer
        $this->authBuyer = Auth::user()->id;
        $this->alamatBuyer = User::find($this->authBuyer)->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->get();
        foreach ($this->alamatBuyer as $key => $value) {
            $this->getAlamatBuyer = $value->id_city;
        }

        // Get Weight
        foreach ($this->cart as $keyWeight) {
            $this->getWeight = $keyWeight->weight;
        }

        // Get Cost
        $this->cost = RajaOngkir::ongkosKirim([
            'origin' => $this->getAlamatKantor,
            'originType' => "city",
            'destination' => $this->getAlamatBuyer,
            'destinationType' => "city",
            'weight' => $this->getWeight,
            'courier' => 'jne:sicepat:anteraja:jnt',
        ])->get();
    }

    public function render()
    {
        return view('livewire.cart.calculate');
    }
}
