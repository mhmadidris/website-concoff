@extends('layouts.front')

@section('title', ' Cart')

@section('content')

    {{-- Navigation bar --}}
    @include('includes.Frontend.navbar')


    <section class="w-100 h-100 breadcrumb-section mt-4">

        <div class="container font-noto-sans">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-4">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('cart.index') }}">Cart</a>
                    </li>
                </ol>
            </nav>
        </div>


        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        @endif

        <section class="cart-checkout w-100 h-100">
            <div class="container p-4">
                <style>
                    .card-product-preview {
                        box-shadow: 0px 4px 40px rgba(172, 172, 172, 0.15);
                        border-radius: 15px;
                        background-color: #ffffff;
                    }

                    .card-product-preview .name-product-preview {
                        font: 400 1rem/1.2rem "Poppins", sans-serif;
                        color: #ADB2B8;
                    }

                    .card-product-preview .name-product-preview .price-preview {
                        font: 500 0.9rem/1.90rem "Poppins", sans-serif;
                        color: #121213;
                    }

                    .card-product-preview .name-product-preview .size-preview {
                        font: 500 0.8rem/1rem "Poppins", sans-serif;
                        color: #585858;
                    }

                    @media (min-width:280px) and (max-width: 576px) {

                        .card-product-mobile-preview .name-product-preview {
                            font: 400 0.9rem/0.7rem "Poppins", sans-serif;
                            color: #ADB2B8;
                        }

                        .card-product-mobile-preview .name-product-preview .price-preview {
                            font: 500 0.8rem/1.4rem "Poppins", sans-serif;
                            color: #121213;
                        }

                        .card-product-mobile-preview .name-product-preview .size-preview {
                            font: 500 0.6rem/0.8rem "Poppins", sans-serif;
                            color: #ADB2B8;
                        }

                        .name-product-preview-size {
                            font: 400 0.7rem/0.3rem "Poppins", sans-serif;
                            color: #585858;
                        }


                    }

                    .card-summary {
                        box-shadow: 0px 4px 40px rgba(172, 172, 172, 0.15);
                        border-radius: 15px;
                        background-color: #ffffff;
                    }

                    .card-product-mobile-preview {
                        box-shadow: 0px 4px 40px rgba(172, 172, 172, 0.15);
                        border-radius: 15px;
                        background-color: #ffffff;
                    }

                    .card-summary .caption-summary {
                        font: 500 1.20rem/1.90rem "Poppins", sans-serif;
                        color: #121213;
                    }

                    .card-summary .preview-summary {
                        font: 400 1rem/1.90rem "Poppins", sans-serif;
                        color: #ADB2B8;
                    }

                    .card-summary .total-summary {
                        font: 500 1rem/1.90rem "Poppins", sans-serif;
                        color: #121213;
                    }

                    .card-summary .input-shipping-details {
                        font: 500 1rem/1.90rem "Poppins", sans-serif;
                        color: #121213;
                        border: 1px solid #020202;
                        box-sizing: border-box;
                        border-radius: 8px;
                    }

                    .card-summary label {
                        font: 500 1rem/1.90rem "Poppins", sans-serif;
                        color: #121213;
                    }

                    .card-summary .btn-confirm {
                        background-color: var(--dull-purple);
                        color: #fff;
                        border-radius: 16px;
                        font: 600 1rem/1.90rem "Poppins", sans-serif;
                    }

                </style>
                <div class="row">
                    <div class="col-12 col-lg-7">
                        @if (count($carts) >= 1)
                            @foreach ($carts as $c)
                                <div class="card-product-preview d-none d-sm-block p-3 mb-3">
                                    <div class="d-flex flex-row">
                                        <div class="col-2">
                                            <?php $property_images = json_decode($c->images); ?>
                                            <img src="{{ asset('/storage/products/images/' . $property_images[0]) }}"
                                                alt="" loading="lazy" class="w-100">
                                        </div>
                                        <div class="col-4 name-product-preview ms-3 text-nowrap">
                                            <div class="font-medium">
                                                {{ $c->title }}
                                            </div>
                                            <div class="size-preview">
                                                Quantity : {{ $c->jumlah }}
                                            </div>
                                            <div class="price-preview">
                                                @currency($c->price)
                                            </div>
                                        </div>


                                        <div
                                            class="col-4 d-flex text-center align-items-center justify-content-center name-product-preview ">
                                            <div class="d-flex justify-content-end gap-4 w-full">
                                                @if ($c->sizeSelected != null)
                                                    <div class="px-3 py-1 rounded text-center text-base text-white font-semibold shadow"
                                                        style="background-color: #b06bff;">
                                                        {{ $c->sizeSelected }}
                                                    </div>
                                                @endif

                                                @if ($c->pilihanSelected != null)
                                                    <div class="px-3 py-1 rounded text-center text-base text-black font-semibold shadow"
                                                        style="background-color: #aaadbe;">
                                                        {{ $c->pilihanSelected }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div
                                            class="col-2 d-flex text-center align-items-center justify-content-center name-product-preview ms-3">

                                            <form action="{{ route('cart.destroy', $c->id_cart) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn">
                                                    <img src="{{ asset('frontend/images/icon-delete.svg') }}" width="20"
                                                        alt="icon-delete">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- mobile verse --}}
                                <div class="card-product-mobile-preview d-block d-sm-none p-3 mb-3">
                                    <div class="d-flex flex-row">
                                        <div class="col-3">
                                            <?php $property_images = json_decode($c->images); ?>
                                            <img src="{{ asset('/storage/products/images/' . $property_images[0]) }}"
                                                alt="image" loading="lazy" class="w-100 rounded-3">
                                        </div>
                                        <div class="col-4 name-product-preview ms-3">

                                            {{ $c->title }}
                                            <div class="size-preview mt-1">
                                                Quantity : {{ $c->jumlah }}
                                            </div>
                                            <div class="price-preview">
                                                @currency($c->price)
                                            </div>
                                        </div>

                                        <div
                                            class="col-4 d-flex text-center align-items-center justify-content-center name-product-preview-size ">
                                            <div class="d-flex justify-content-end gap-1 w-50">
                                                @if ($c->sizeSelected != null)
                                                    <div class="px-3 py-2 rounded text-center text-base text-white font-semibold shadow"
                                                        style="background-color: #b06bff;">
                                                        {{ $c->sizeSelected }}
                                                    </div>
                                                @endif

                                                @if ($c->pilihanSelected != null)
                                                    <div class="px-3 py-2 rounded text-center text-base text-black font-semibold shadow"
                                                        style="background-color: #aaadbe;">
                                                        {{ $c->pilihanSelected }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-1 d-flex justify-content-center align-items-center text-center">


                                            <form action="{{ route('cart.destroy', $c->id_cart) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn me-2">
                                                    <img src="{{ asset('frontend/images/icon-delete.svg') }}" width="15"
                                                        alt="icon-delete">
                                                </button>
                                            </form>
                                        </div>


                                    </div>

                                    <div class="d-flex flex-row float-end ">


                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="error-details">
                                Keranjang kamu kosong nih! Ayo belanja dulu
                            </div>
                        @endif


                    </div>

                    <div class="col-12 col-lg-5">
                        <form action="{{ route('dashboard.transaction.store') }}" method="POST">
                            @csrf
                            <div class="card-summary px-lg-4 px-3 py-3 mb-3">
                                <div class="caption-summary mb-3">
                                    Informasi Pembayaran
                                </div>
                                @if (count($carts) >= 1)
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($carts as $c)
                                        <div class="preview-summary">
                                            {{ $c->title }} ({{ $c->jumlah }} item)

                                            <span class="float-end">
                                                @currency($c->price * $c->jumlah)
                                            </span>
                                        </div>
                                        @php
                                            $totalHargaItem = $c->price * $c->jumlah;
                                            $totalPrice += $totalHargaItem;
                                        @endphp
                                    @endforeach
                                @else
                                    <p class="text-center opacity-50">Belum ada barang ditambahkan.</p>
                                @endif

                                @if (count($carts) >= 1)
                                    <livewire:cart.calculate :cartsPrice="$totalPrice" />
                                @endif
                            </div>

                            @if (count($carts) >= 1)
                                <div class="card-summary px-lg-4 px-3 py-3 mb-3">
                                    <div class="caption-summary mb-3">
                                        Notes (optional)
                                    </div>
                                    @foreach ($carts as $c)
                                        <input type="text" name="idCart[]" value="{{ $c->id_cart }}" hidden>
                                    @endforeach

                                    {{-- <label for="namaPembeli" class="mb-1">Name</label>
                                    <div class="input-group w-100 mx-auto mb-2">

                                        <input type="text" placeholder="John Smith" name="namaPembeli" id="namaPembeli"
                                            class="form-control input-shipping-details" required>
                                    </div>

                                    <label for="emailPembeli" class="mb-1">Email</label>
                                    <div class="input-group w-100 mx-auto mb-2">

                                        <input type="email" placeholder="john@example.com" name="emailPembeli"
                                            id="emailPembeli" class="form-control input-shipping-details" required>
                                    </div>

                                    <label for="nomorPembeli" class="mb-1">Phone Number</label>
                                    <div class="input-group w-100 mx-auto mb-2">

                                        <input type="text" placeholder="08xxxxxxxxxx" name="nomorPembeli" id="nomorPembeli"
                                            class="form-control input-shipping-details" required>
                                    </div> --}}



                                    {{-- Catatan Dari Pembeli --}}
                                    {{-- <label for="notes" class="mb-1">Notes</label> --}}
                                    <div class="input-group w-100 mx-auto mb-2">

                                        <textarea name="notes" placeholder="Jangan lupa dikirim ya!" id="notes" class="form-control input-shipping-details"
                                            style="resize: none;" cols="10" rows="5"></textarea>
                                    </div>


                                    <button type="submit" class="btn btn-confirm d-inline-block w-100 p-2 mt-4">
                                        Checkout Now
                                    </button>

                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </section>

@endsection


{{-- <label for="email" class="mb-1">Email</label>
<div class="input-group w-100 mx-auto mb-2">

    <input type="text" id="email" class="form-control input-shipping-details" max="100" placeholder="Email penerima" />

</div>

<label for="number_phone" class="mb-1">No Handphone</label>
<div class="input-group w-100 mx-auto mb-2">

    <input type="text" id="number_phone" class="form-control input-shipping-details" max="100"
        placeholder="No Handphone penerima" />

</div>

<label for="address" class="mb-1">Alamat Lengkap</label>
<div class="input-group w-100 mx-auto mb-2">

    <input type="text" id="address" class="form-control input-shipping-details" max="100"
        placeholder="Alamat Lengkap penerima" />

</div> --}}
