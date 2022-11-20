@extends('layouts.app')

@section('title', ' My Transaction')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        All Customer Transactions
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
                                        <th class="py-4" scope="">Name</th>
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
                                    @foreach ($orderData->first() as $o)
                                        <tr class="text-gray-700 border-b">
                                            <td class="px-1 py-5 text-sm w-2/8">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <p class="font-medium text-black">{{ $o->kode_order }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-1 py-5 text-sm">
                                                {{ $o->name }}
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

                                            @if ($o->status_transaksi == 'Pending')
                                                <td class="px-1 py-5 text-sm">
                                                    <a href="{{ route('dashboard.transaction.edit', $o->kode_order) }}"
                                                        class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email">
                                                        Edit
                                                    </a>
                                                </td>
                                            @else
                                                <td class="px-0 py-5 text-sm">
                                                    <a href="{{ route('dashboard.transaction.edit', $o->kode_order) }}"
                                                        class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email">
                                                        Show
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $orderData->links() }}
                    </main>
                </div>
            </section>
        @endif
    </main>

@endsection
