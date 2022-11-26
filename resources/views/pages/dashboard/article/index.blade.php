@extends('layouts.app')

@section('title', ' Voucher')

@section('content')

<main class="h-full overflow-y-auto">
    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-8">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    ConCoff Voucher
                </h2>
                <p class="text-sm text-gray-400">
                    {{ $article->count() }} Total Voucher
                </p>
            </div>
            <div class="col-span-4 lg:text-right">
                <div class="relative mt-0 md:mt-6">
                    <a href="{{ route('dashboard.article.create') }}" class="inline-block px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                        + Add New Voucher
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="container px-6 mx-auto mt-5">
        <div class="grid gap-5 md:grid-cols-12">
            <main class="col-span-12 p-4 md:pt-0">
                <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                    <!--Card 1-->
                    @foreach ($article as $a)
                    {{-- @php
                    dd($a->resource->data()['key']);
                    @endphp --}}
                    <div class="rounded overflow-hidden shadow-lg bg-white">
                        <div class="flex flex-row justify-between items-center py-2 px-3">
                            <h2 class="font-semibold text-lg">Voucher</h2>

                            <style>
                                .b1 {
                                    opacity: 0.25;
                                }

                                .b1:hover {
                                    opacity: 1;
                                }

                                .b2 {
                                    opacity: 0.25;
                                }

                                .b2:hover {
                                    opacity: 1;
                                }

                            </style>

                            <div class="flex flex-row">
                                <div class="mr-2 b1">
                                    <a href="">
                                        <img src="https://img.icons8.com/ios-glyphs/22/undefined/edit--v1.png" />
                                    </a>
                                </div>

                                <style>
                                    .vl {
                                        border-left: 2px solid rgb(58, 58, 58);
                                        opacity: 0.25;
                                        border-radius: 50%;
                                    }

                                </style>

                                <div class="vl" class="h-full"></div>

                                <form action="" method="POST">

                                    <button type="submit" class="ml-2 b2">
                                        <img src="https://img.icons8.com/small/22/undefined/filled-trash.png" />
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="px-6 py-4">
                            <img class="w-24 mb-2" style="margin: auto;" src="{{ asset('concoff/Ticket.svg') }}" alt="Logo Header">

                            {{-- Title Header --}}
                            <a href="">
                                <div class="font-bold text-xl mb-2">
                                    {{ $a['titleVoucher'] }}
                                </div>
                            </a>
                            <p class="text-gray-700 text-base" style="text-align: justify;">
                                {{ \Illuminate\Support\Str::limit($a['desc'], 150, $end = '...') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </main>
        </div>
    </section>
</main>
@endsection
