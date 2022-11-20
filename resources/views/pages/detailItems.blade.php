@extends('layouts.app')

@section('title', ' Detail Order')

@section('content')

    <main class="h-full overflow-y-auto">
        <!-- breadcrumb -->
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Detail Item
                    </h2>

                    @php
                        foreach ($orderShow as $os) {
                            $ka = $os;
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

                        @if (Auth::user()->hasRole('admin'))
                            <li class="flex items-center">
                                <a href="{{ route('dashboard.transaction.edit', $ka->kode_order) }}"
                                    class="text-gray-400">{{ $ka->kode_order }}</a>
                                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 320 512">
                                    <path
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                                </svg>
                            </li>
                        @else
                            <li class="flex items-center">
                                <a href="{{ route('dashboard.transaction.show', $ka->kode_order) }}"
                                    class="text-gray-400">{{ $ka->kode_order }}</a>
                                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 320 512">
                                    <path
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                                </svg>
                            </li>
                        @endif
                        <li class="flex items-center">
                            <a href="{{ route('detail.show', $ka->id_cart) }}"
                                class="font-medium">{{ $ka->title }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="bg-white rounded-xl">
                        <section class="pt-6 pb-20 mx-8 w-auth">
                            @foreach ($orderShow as $ka)
                                <div class="grid gap-5 md:grid-cols-12">
                                    <main class="p-lg-4 p-1 lg:col-span-7 md:col-span-12">


                                        <!-- details heading -->
                                        <div class="details-heading">
                                            <h1 class="text-2xl font-semibold">{{ $ka->title }}</h1>
                                        </div>
                                        <div class="p-3 my-4 bg-gray-100 rounded-lg image-gallery" x-data="gallery()">
                                            @php
                                                $image = json_decode($ka->images);
                                            @endphp
                                            <img src="{{ asset('/storage/products/images/' . $image[0]) }}" alt=""
                                                class="rounded-lg cursor-pointer w-100" data-lity id="imgDisp">
                                            <div class="flex overflow-x-scroll hide-scroll-bar dragscroll">
                                                <div class="flex mt-2 flex-nowrap">
                                                    @foreach (json_decode($ka->images, true) as $as)
                                                        <img src="{{ asset('/storage/products/images/' . $as) }}"
                                                            class="inline-block w-24 mr-2 rounded-lg cursor-pointer"
                                                            onclick="changeImage('{{ asset('/storage/products/images/' . $as) }}')"
                                                            alt="">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div>
                                                <!-- The tabs content -->
                                                <div class="leading-8 text-md">
                                                    <h2 class="text-xl font-semibold">About This <span
                                                            class="text-serv-button">Product</span></h2>
                                                    <div class="mt-4 mb-8 content-description">
                                                        <p>
                                                            {{ $ka->desc }}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </main>
                                    <aside class="p-1 lg:p-4 lg:col-span-5 md:col-span-12 md:pt-0">
                                        <div class="mb-4 rounded-lg border-serv-testimonial-border">
                                            {{-- <div
                                                class="flex items-center px-2 py-3 mx-4 mt-4 border rounded-full border-serv-testimonial-border">
                                                <div class="flex-1 text-sm font-medium text-center">
                                                    <svg class="inline" width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="12" r="8" stroke="#082431" stroke-width="1.5" />
                                                        <path d="M12 7V12L15 13.5" stroke="#082431" stroke-width="1.5"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                    7 Days Delivery
                                                </div>
                                                <div class="flex-1 text-sm font-medium text-center">
                                                    <svg class="inline" width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="24" height="24" fill="white" />
                                                        <path
                                                            d="M19 13C19 15 19 18.5 14.6552 18.5C9.63448 18.5 6.12644 18.5 5 18.5"
                                                            stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                        <path d="M4 11.5C4 9.5 4 6 8.34483 6C13.2455 6 16.8724 6 18 6"
                                                            stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                        <path
                                                            d="M7 21.5L4.14142 18.6414C4.06332 18.5633 4.06332 18.4247 4.14142 18.3586L7 15.5"
                                                            stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                        <path
                                                            d="M16 3L18.8586 5.85858C18.9247 5.92468 18.9247 6.06332 18.8586 6.14142L16 9"
                                                            stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    1 Revision Limit
                                                </div>
                                            </div> --}}
                                            <div style="padding-top: 5em;" class="pt- pb-2 features-list">
                                                <table class="w-full mb-2">

                                                    @if ($ka->sizeSelected != null)
                                                        <tr>
                                                            <td class="text-sm text-serv-text">
                                                                Size
                                                            </td>
                                                            <td class="mb-4 text-sm font-semibold text-right text-black">
                                                                {{ $ka->sizeSelected }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if ($ka->pilihanSelected != null)
                                                        <tr>
                                                            <td class="text-sm text-serv-text">
                                                                Warna/Tipe :
                                                            </td>
                                                            <td class="mb-4 text-sm font-semibold text-right text-black">
                                                                {{ $ka->pilihanSelected }}
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td class="text-sm leading-7 text-serv-text">
                                                            Jumlah
                                                        </td>
                                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                                            {{ $ka->jumlah }} Jumlah Barang
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-sm leading-7 text-serv-text">
                                                            Berat Barang
                                                        </td>
                                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                                            {{ $ka->weight }} gram
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-sm leading-7 text-serv-text">
                                                            Harga Satuan
                                                        </td>
                                                        <td class="mb-4 text-sm font-semibold text-right text-black">
                                                            @currency($ka->price)
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>
                                            <div>
                                                <table class="w-full mb-4">
                                                    <tr>
                                                        <td class="text-sm leading-7 text-serv-text">
                                                            Total Harga:
                                                        </td>
                                                        <td class="mb-4 text-xl font-semibold text-right text-serv-button">
                                                            @currency($ka->jumlah * $ka->price)
                                                        </td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </aside>

                                </div>
                            @endforeach
                        </section>
                    </div>
                </main>
            </div>
        </section>
    </main>

@endsection

@push('after-script')
    <script>
        function changeImage(imgName) {
            image = document.getElementById('imgDisp');
            image.src = imgName;
        }
    </script>

    {{-- <script>
        function gallery() {
            return {
                featured: '{{ asset('/storage/products/images/' . $image[0]) }}',
                active: 1,
                changeThumbnail: function(url, position) {
                    this.featured = url;
                    this.active = position;
                }
            }
        }
    </script> --}}
@endpush
