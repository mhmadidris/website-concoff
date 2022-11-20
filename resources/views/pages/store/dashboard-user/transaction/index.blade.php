@extends('layouts.app')

@section('title', ' Transaction')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        My Transaction
                    </h2>
                    <p class="text-sm text-gray-400">
                        {{ count($orderData) }} Total Transactions
                    </p>
                </div>
                <div class="col-span-4 lg:text-right">

                </div>
            </div>
        </div>

        @if (count($orderData) >= 1)
            <section class="container px-6 mx-auto mt-5">
                <div class="grid gap-5 md:grid-cols-12">
                    <main class="col-span-12 p-4 md:pt-0">
                        <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                            <table class="w-full" aria-label="Table">
                                <thead>
                                    <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                        <th class="py-4" scope="">Order Code</th>
                                        <th class="py-4" scope="">Total Jenis Barang</th>
                                        <th class="py-4" scope="">Date Order</th>
                                        <th class="py-4" scope="">Total Price</th>
                                        <th class="py-4" scope="">Status</th>
                                        <th class="py-4" scope="">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    {{-- @php
                                            $joinCart = $o
                                                ->join('carts', 'orders.id_order', '=', 'carts.id_order')
                                                ->where('carts.id_order', $o->id_order)
                                                ->get();
                                        @endphp --}}
                                    {{-- @foreach ($cartData as $a)
                                            {{ $a->title }}
                                        @endforeach --}}
                                    @foreach ($orderData as $o)
                                        <tr class="text-gray-700 border-b">
                                            <td class="px-1 py-5 text-sm w-2/8">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <p class="font-medium text-black">{{ $o->kode_order }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            @php
                                                $a = $getCart->where('id_order', $o->orderID);
                                                foreach ($a as $keyCart) {
                                                    $as = $keyCart;
                                                    //dd($as);
                                                }
                                            @endphp
                                            <td class="px-1 py-5 text-sm">
                                                <div class="flex justify-around items-center">
                                                    <div class="w-12 h-12 overflow-hidden rounded-full">
                                                        @foreach (json_decode($as->images, true) as $ha)
                                                            <img src="{{ asset('/storage/products/images/' . $ha) }}"
                                                                alt="product">
                                                        @endforeach
                                                    </div>
                                                    <p class="font-medium" style="padding-left: 0.75em;">
                                                    <div class="flex flex-col">
                                                        <h5 class="font-bold">
                                                            {{ $as->title }}
                                                        </h5>
                                                        <h5>
                                                            Qty : {{ $as->jumlah }}
                                                        </h5>
                                                    </div>
                                                    </p>
                                                </div>
                                                <p class="pt-4">
                                                    @if (count($a) > 1)
                                                        {{ '+' . count($a) - 1 . ' Jenis Barang Lainnya' }}
                                                    @endif
                                                </p>
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
                                            <td class="px-1 py-5 text-sm">
                                                <a href="{{ route('dashboard.transaction.show', $o->kode_order) }}"
                                                    class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $orderData->links('vendor.pagination.simple-tailwind') }}
                    </main>
                </div>
            </section>
        @endif
    </main>

@endsection
