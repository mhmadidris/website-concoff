@extends('layouts.app')

@section('title', ' Dashboard')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Dashboard
                    </h2>
                    <p class="text-sm text-gray-400">
                        Admin Dashboard
                    </p>
                </div>
                <div class="col-span-4 text-right">
                    <div @click.away="open = false" class="relative z-10 hidden mt-5 lg:block" x-data="{ open: false }">
                        <button
                            class="flex flex-row items-center w-full px-4 py-2 mt-2 text-left bg-white rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4">
                            <svg class="inline w-12 h-12 mr-3 rounded-full text-gray-300" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            {{-- <img class="inline w-12 h-12 mr-3 rounded-full" src="https://randomuser.me/api/portraits/men/1.jpg" alt=""> --}}
                            {{ Auth::user()->name }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            @if (Auth::user()->type_addres == null && Auth::user()->id_province == null && Auth::user()->id_city == null && Auth::user()->detail_address == null && Auth::user()->zipcode == null)
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">
                    <span class="font-medium">Peringatan!</span> Anda belum memasukkan alamat, harap mengisi alamat
                    terlebih
                    dahulu <a href="{{ route('dashboard.profile.edit', Auth::user()->id) }}"
                        style="text-decoration: underline; color: blue;">disini</a>.
                </div>
            @endif

            <div class="grid gap-5 md:grid-cols-12">
                <main class="p-4 lg:col-span-7 md:col-span-12 md:pt-0">
                    <div class="flex flex-col w-full">
                        <div class="sm:grid sm:gap-4 sm:grid-cols-3">
                            <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                                <div>
                                    <div>
                                        <img src="{{ asset('/assets/images/services-progress-icon.svg') }}" alt=""
                                            class="w-8 h-8">
                                    </div>

                                    @php
                                        $sukses = $order->where('status_transaksi', '=', 'Success');
                                    @endphp

                                    <p class="mt-2 text-2xl font-semibold text-left text-gray-800">{{ count($sukses) }}
                                    </p>
                                    <p class="text-sm text-left text-gray-500">
                                        Transaction <br class="hidden lg:block">
                                        Success
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                                <div>
                                    <div>
                                        <img src="{{ asset('/assets/images/services-completed-icon.svg') }}" alt=""
                                            class="w-8 h-8">
                                    </div>

                                    @php
                                        $pending1 = $order->where('status_transaksi', '=', 'Pending');
                                        $pending2 = $order->where('status_transaksi', '=', 'Waiting');
                                    @endphp

                                    @if ($pending1 || $pending2)
                                        <p class="mt-2 text-2xl font-semibold text-left text-gray-800">
                                            {{ count($pending1) + count($pending2) }}
                                        </p>
                                    @else
                                        <p class="mt-2 text-2xl font-semibold text-left text-gray-800">0
                                        </p>
                                    @endif
                                    <p class="text-sm text-left text-gray-500">
                                        Transaction <br class="hidden lg:block">
                                        Pending
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                                <div>
                                    <div>
                                        <img src="{{ asset('assets/images/expired.png') }}" alt="" class="w-8 h-8">
                                    </div>

                                    @php
                                        $expired = $order->where('status_transaksi', '=', 'Expired');
                                    @endphp

                                    <p class="mt-2 text-2xl font-semibold text-left text-gray-800">
                                        {{ count($expired) }}
                                    </p>
                                    <p class="text-sm text-left text-gray-500">
                                        Transaction <br class="hidden lg:block">
                                        Expired
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                                <div>
                                    <div>
                                        <img src="{{ asset('assets/images/delivery.png') }}" alt=""
                                            class="w-8 h-8">
                                    </div>

                                    @php
                                        $expired = $order->where('status_transaksi', '=', 'Sedang Dikirim');
                                    @endphp

                                    <p class="mt-2 text-2xl font-semibold text-left text-gray-800">
                                        {{ count($expired) }}
                                    </p>
                                    <p class="text-sm text-left text-gray-500">
                                        Transaction Shipment
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                                <div>
                                    <div>
                                        <img src="{{ asset('/assets/images/new-freelancer-icon.svg') }}" alt=""
                                            class="w-8 h-8">
                                    </div>
                                    <p class="mt-2 text-2xl font-semibold text-left text-gray-800">
                                        {{ count($countCustomer) }}
                                    </p>
                                    <p class="text-sm text-left text-gray-500">
                                        Customers
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-center px-4 py-4 mb-4 bg-white rounded-xl">
                                <div>
                                    <div>
                                        <img src="{{ asset('assets/images/product.png') }}" alt=""
                                            class="w-8 h-8">
                                    </div>
                                    <p class="mt-2 text-2xl font-semibold text-left text-gray-800">
                                        {{ count($products) }}
                                    </p>
                                    <p class="text-sm text-left text-gray-500">
                                        Products
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- <h5 class="text-base font-medium">Latest Transactions</h5>
                        <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                            <table class="w-full" aria-label="Table">
                                <thead>
                                    <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                        <th class="py-4" scope="">Order Code</th>
                                        <th class="py-4" scope="">Date Order</th>
                                        <th class="py-4" scope="">Total Price</th>
                                        <th class="py-4" scope="">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($orderData as $o)
                                        <tr class="text-gray-700 border-b">
                                            <td class="px-1 py-5 text-sm w-2/8">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <p class="font-medium text-black">{{ $o->kode_order }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-1 py-5 text-sm">
                                                @php
                                                    $date = date_create($o->date_order);
                                                @endphp
                                                {{ date_format($date, 'D, d/m/y') }}
                                                <br>
                                                {{ date_format($date, 'H:i:s') }}
                                            </td>
                                            <td class="px-1 py-5 text-sm">
                                                @currency($o->totalCost)
                                            </td>

                                            @if ($o->status_transaksi == 'Pending')
                                                <td class="px-1 py-5 text-sm text-red-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @elseif ($o->status_transaksi == 'Waiting')
                                                <td class="px-1 py-5 text-sm text-purple-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @elseif ($o->status_transaksi == 'Sedang Dikirim')
                                                <td class="px-1 py-5 text-sm text-blue-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @elseif ($o->status_transaksi == 'Telah Dikirim')
                                                <td class="px-1 py-5 text-sm text-green-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @elseif ($o->status_transaksi == 'Pending')
                                                <td class="px-1 py-5 text-sm text-red-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @elseif ($o->status_transaksi == 'Sedang Dikirim')
                                                <td class="px-1 py-5 text-sm text-blue-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @elseif ($o->status_transaksi == 'Telah Dikirim')
                                                <td class="px-1 py-5 text-sm text-pink-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @else
                                                <td class="px-1 py-5 text-sm text-green-500 text-md">
                                                    {{ $o->status_transaksi }}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </main>
                <aside class="p-4 lg:col-span-5 md:col-span-12 md:pt-0">
                    <div
                        class="relative w-full h-56 m-auto text-white transition-transform transform bg-red-100 rounded-xl">

                        <img class="relative object-cover w-full h-full rounded-xl"
                            src="{{ asset('/assets/images/card-background.png') }}" alt="">

                        <div class="absolute w-full px-8 top-8 pt-4">
                            <div class="flex justify-between">
                                @php
                                    // Succes
                                    $succesBalance = $order->where('status_transaksi', '=', 'Success')->sum('totalCost');
                                @endphp
                                <div class="">
                                    <p class="font-light">
                                        Success Balance
                                        </h1>
                                    <p class="font-medium tracking-widest">
                                        @currency($succesBalance)
                                    </p>
                                </div>
                                <div class="w-10 h-10 text-white p-2 rounded-full" style="background-color: white;">
                                    <img src="{{ asset('assets/images/succe.png') }}" alt="">
                                </div>
                                {{-- <img class="w-16 h-12" src="{{ asset('/assets/images/visa-icon.svg') }}" alt="" /> --}}
                            </div>

                            <br>
                            <br>

                            <div class="flex justify-between">
                                @php
                                    // Waiting
                                    $pendingBalance1 = $order->where('status_transaksi', '=', 'Waiting')->sum('totalCost');
                                    // Pending
                                    $pendingBalance2 = $order->where('status_transaksi', '=', 'Pending')->sum('totalCost');
                                    $pendingBalance3 = $order->where('status_transaksi', '=', 'Sedang Dikirim')->sum('totalCost');
                                @endphp
                                <div class="">
                                    <p class="font-light">
                                        Pending Balance
                                        </h1>
                                    <p class="font-medium tracking-widest">
                                        @currency($pendingBalance1 + $pendingBalance2 + $pendingBalance3)
                                    </p>
                                </div>
                                <div class="w-10 h-10 text-white p-2 rounded-full" style="background-color: white;">
                                    <img src="{{ asset('assets/images/pending.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>

@endsection
