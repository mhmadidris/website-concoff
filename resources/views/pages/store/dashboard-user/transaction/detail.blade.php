@extends('layouts.app')

@section('title', ' Transaction')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Your Transaction
                    </h2>

                    @php
                        foreach ($orderShow as $os) {
                            $ka = $os;
                            //dd($ka);
                        }
                    @endphp
                    <ol class="inline-flex py-2 list-none">
                        <li class="flex items-center">
                            <a href="{{ route('dashboard.transaction.index') }}" class="text-gray-400">My Transaction</a>
                            <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512">
                                <path
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <a href="{{ route('dashboard.transaction.show', $ka->kode_order) }}"
                                class="font-medium">{{ $ka->kode_order }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-2">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">

                    @if ($ka->status_transaksi == 'Sedang Dikirim')
                        <div class="p-4 mb-4 text-sm rounded-lg text-blue-700" style="background-color: #259ed6;"
                            role="alert">
                            <span class="font-medium">Perkiraan sampai!</span> Perkiraan paket sampai pada
                            <b>{{ date('D, d-M-Y', strtotime($ka->date_end)) }}<b>.
                        </div>
                    @endif

                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                        <div class="flex justify-between pt-6">
                            <div>
                                <label for="transaction detail" class="block mb-3 font-medium text-md"
                                    style="font-weight: 700;">Transaction Detail</label>
                                {{-- <label for="transaction detail" class="block mb-3 font-medium text-sm"
                                    style="font-weight: 400;">{{ $ka->id_order }}</label> --}}
                            </div>
                            @if ($ka->status_transaksi == 'Pending')
                                <span
                                    class="inline-flex items-center justify-center px-4 py-3 mb-4 mr-2 text-sm leading-none text-white font-semibold rounded-md"
                                    style="background-color: #80dd07;">{{ $ka->status_transaksi }}</span>
                            @elseif ($ka->status_transaksi == 'Waiting')
                                <span
                                    class="inline-flex items-center justify-center px-4 py-3 mb-4 mr-2 text-sm leading-none text-white font-semibold rounded-md"
                                    style="background-color: #a007dd;">{{ $ka->status_transaksi }}</span>
                            @elseif ($ka->status_transaksi == 'Sedang Dikirim')
                                <span
                                    class="inline-flex items-center justify-center px-4 py-3 mb-4 mr-2 text-sm leading-none text-white font-semibold rounded-md"
                                    style="background-color: #008bcc;">{{ $ka->status_transaksi }}</span>
                            @elseif ($ka->status_transaksi == 'Success')
                                <span
                                    class="inline-flex items-center justify-center px-4 py-3 mb-4 mr-2 text-sm leading-none text-white font-semibold rounded-md"
                                    style="background-color: #17e72f;">{{ $ka->status_transaksi }}</span>
                            @endif
                        </div>
                        <table class="w-full" aria-label="Table">
                            <thead>
                                <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                    <th class="py-4" scope="">Product Name</th>
                                    <th class="py-4" scope="">Quantity</th>
                                    <th class="py-4" scope="">Warna/Tipe</th>
                                    <th class="py-4" scope="">Total Price/Item</th>
                                    <th class="py-4" scope="">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($orderShow as $os)
                                    <tr class="text-gray-700 border-b">
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div class="relative w-10 h-10 mr-3 rounded-full md:block">
                                                    @php
                                                        $img = json_decode($os->images);
                                                        //dd($img[0]);
                                                    @endphp
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="{{ asset('/storage/products/images/' . $img[0]) }}" alt=""
                                                        loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-black">{{ $os->title }}</p>
                                                    @if ($os->pilihanSelected != null)
                                                        <p class="text-sm text-gray-400">Warna/Tipe :
                                                            {{ $os->pilihanSelected }}
                                                        </p>
                                                    @endif
                                                    @if ($os->sizeSelected != null)
                                                        <p class="text-sm text-gray-400">Size : {{ $os->sizeSelected }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="w-2/6 px-1 py-5">
                                        <div class="flex items-center text-sm">
                                            <div class="relative w-10 h-10 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded" src="https://randomuser.me/api/portraits/men/3.jpg" alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-medium text-black">
                                                    Design WordPress <br>E-Commerce Modules
                                                </p>
                                            </div>
                                        </div>
                                    </td> --}}
                                        <td class="px-1 py-5 text-sm">
                                            {{ $os->jumlah }}
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            {{ $os->pilihanSelected }}
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            @currency($os->price * $os->jumlah)
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            <a href="{{ route('detailitem.show', $os->id_cart) }}"
                                                class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email">
                                                Details

                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @php
                            foreach ($orderShow as $key => $value) {
                                $get = $value;
                            }
                            
                        @endphp

                        @if ($get->notes != null)
                            <div class="py-2">
                                <h3 style="font-size: 1.1rem; font-weight: 800;">Catatan
                                </h3>
                                <p class="text-justify">{{ $get->notes }}</p>
                            </div>
                        @endif

                        <div class="pt-6">
                            <h3 class="pb-2" style="font-size: 1.1rem; font-weight: 800;">Data Pemesan
                            </h3>

                            <table class="w-full mb-2">
                                <tr>
                                    <td class="text-sm text-serv-text">
                                        Name
                                    </td>
                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                        {{ $value->name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm leading-7 text-serv-text">
                                        Email
                                    </td>
                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                        {{ $value->email }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm leading-7 text-serv-text">
                                        Phone Number
                                    </td>
                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                        {{ $value->phone_number }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm leading-7 text-serv-text">
                                        Tipe Alamat
                                    </td>
                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                        {{ $value->type_address }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm leading-7 text-serv-text">
                                        Province
                                    </td>
                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                        @php
                                            $conProv = $province->where('province_id', $value->id_province);
                                            foreach ($conProv as $keyProv) {
                                                $getProv = $keyProv;
                                            }
                                        @endphp
                                        {{ $getProv->name_province }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm leading-7 text-serv-text">
                                        City
                                    </td>
                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                        @php
                                            $conCity = $city->where('city_id', $value->id_city);
                                            foreach ($conCity as $keyCity) {
                                                $getCity = $keyCity;
                                            }
                                        @endphp
                                        {{ $getCity->type . ' ' . $getCity->name_city }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm leading-7 text-serv-text">
                                        Postal Code
                                    </td>
                                    <td class="mb-4 text-sm font-semibold text-right text-black">
                                        {{ $value->zipcode }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-sm leading-7 text-serv-text">
                                        Detail Address
                                    </td>
                                    <td class="w-1/2 mb-4 text-sm font-semibold text-right text-black">
                                        {{ $value->detail_address }}
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div style="padding-top: 2em;">
                            <h3 style="font-size: 1.1rem; font-weight: 800;">Ringkasan Pemesanan
                            </h3>
                            <div style="padding-top: 1em;" class="pt- pb-2 features-list">
                                <table class="w-full mb-4">
                                    <tr>
                                        <td class="text-sm text-serv-text">
                                            Order
                                        </td>
                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                            {{ $value->kode_order }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm text-serv-text">
                                            Tanggal Order
                                        </td>
                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                            @php
                                                $date = date_create($value->date_order);
                                            @endphp
                                            {{ date_format($date, 'D, d/m/y') }}
                                        </td>
                                    </tr>
                                </table>

                                <table class="w-full mb-2">
                                    <tr>
                                        <td class="text-sm leading-7 text-serv-text">
                                            Jasa Kurir
                                        </td>
                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                            {{ $value->id_kurir }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm leading-7 text-serv-text">
                                            Jenis Pengiriman
                                        </td>
                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                            {{ $value->id_jenisKurir }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm leading-7 text-serv-text">
                                            Nomor Resi
                                        </td>
                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                            @if ($value->nomorResi != null)
                                                {{ $value->nomorResi }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-sm leading-7 text-serv-text">
                                            Ongkos Kirim
                                        </td>
                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                            @currency($value->ongkir)
                                        </td>
                                    </tr>

                                </table>

                                <table class="w-full mb-4">
                                    <tr>
                                        <td class="text-sm leading-7 text-serv-text">
                                            Total Pembayaran:
                                        </td>
                                        <td class="mb-4 text-xl font-semibold text-right text-serv-button">
                                            @currency($value->totalCost)
                                        </td>
                                    </tr>

                                </table>

                                <style>
                                    .payButton {
                                        background-color: #44c767;
                                        border-radius: 7px;
                                        border: 1px solid #18ab29;
                                        display: inline-block;
                                        cursor: pointer;
                                        color: #ffffff;
                                        font-family: Verdana;
                                        font-size: 17px;
                                        font-weight: bold;
                                        padding: 5px 76px;
                                        text-decoration: none;
                                        text-shadow: 0px 1px 15px #2f6627;
                                    }

                                    .payButton:hover {
                                        background-color: #59ff00;
                                    }

                                    .payButton:active {
                                        position: relative;
                                        top: 1px;
                                    }

                                </style>
                                @php
                                    //dd($payment->where('id_order', $value->id_order)->count());
                                    $getPayCount = $payment->where('id_order', $value->id_order)->count();
                                @endphp

                                <div class="flex flex-row justify-between">
                                    <div style="width: 80%;">
                                        @if ($value->status_transaksi == 'Pending')
                                            @if ($getPayCount == 0)
                                                <button class="payButton" style="background-color: blue; width: 100%;"
                                                    id="pay-button">
                                                    Bayar
                                                </button>
                                            @else
                                                <button class="payButton"
                                                    style="background-color: yellow; width: 100%;" id="pay-button">
                                                    Show
                                                </button>
                                            @endif
                                        @else
                                            @if ($value->status_transaksi == 'Sedang Dikirim')
                                                <form action="/update/success" method="POST">
                                                    @csrf
                                                    <input type="text" name="id_sukses"
                                                        value="{{ $value->id_transaction }}" hidden>
                                                    <button class="payButton"
                                                        style="background-color: rgb(14, 157, 182); width: 100%; border-color: transparent;">
                                                        Barang Sudah Sampai
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>

                                    @if ($value->status_transaksi != 'Pending')
                                        <div class="text-right" style="width: 20%;">
                                            <a href="{{ url('/transaction/download', $get->kode_order) }}"
                                                target="_blank">
                                                <button
                                                    class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-4 rounded inline-flex items-center text-white"
                                                    style="background-color: #F40F02;">
                                                    <svg class="fill-current w-4 h-4 mr-2"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                    </svg>
                                                    <span>Download PDF</span>
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </section>

        {{-- <livewire:transaction.push-payment-data :get="$as" /> --}}

        <form action="/transaction/payment" id="submit_form" method="POST">
            @csrf
            <input type="hidden" name="idOrder" value="{{ $get->id_order }}">
            <input type="text" name="json" id="json_callback" hidden>
        </form>

    </main>
    <script type="text/javascript">
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            snap.pay('{{ $snap_token }}', {
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    // console.log(result)
                    if ('{{ $getPayCount == 0 }}') {
                        send_response_to_form(result);
                    }
                },
            });
        });


        function send_response_to_form(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit_form').submit();
        }
    </script>
@endsection
