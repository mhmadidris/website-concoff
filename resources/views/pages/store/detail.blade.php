@extends('layouts.front')

@section('title', ' Detail')

@section('content')

    {{-- Navigation bar --}}
    @include('includes.Frontend.navbar')

    @if (Auth::user())
        <div class="px-4">
            @if (Auth::user()->type_addres == null && Auth::user()->id_province == null && Auth::user()->id_city == null && Auth::user()->detail_address == null && Auth::user()->zipcode == null)
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">
                    <span class="font-medium">Peringatan!</span> Anda belum memasukkan alamat, harap mengisi alamat
                    terlebih
                    dahulu <a href="{{ route('dashboard.profile.edit', Auth::user()->id) }}"
                        style="text-decoration: underline; color: blue;">disini</a>.
                </div>
            @endif
        </div>
    @endif

    <section class="w-100 h-100 breadcrumb-section mt-4">
        <div class="container font-noto-sans">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-4">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Notification Alert --}}
    {{-- <div class="alert alert-primary" role="alert">
        Barang berhasil ditambahkan lihat <a href="/cart" class="alert-link"> keranjang belanja anda</a>.
    </div> --}}

    @foreach ($data as $d)
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf

            <input type="text" name="idProduct" id="idProduct" value="{{ $d->id_product }}" hidden>
            <section class="w-100 h-100 detail-product">
                <div class="container mt-4 pb-5">
                    <div class="row">
                        <div class="col-12 col-lg-7 ">
                            <div class="card-product p-4">

                                @php
                                    $property_images = json_decode($d->images);
                                @endphp
                                <img src="{{ asset('/storage/products/images/' . $property_images[0]) }}"
                                    class="w-100" alt="" id="imgDisp">

                                <div class="carousel pt-2"
                                    data-flickity='{ "cellAlign": "left", "contain": true, "groupCells": true, "wrapAround": false, "prevNextButtons": false, "draggable": true, "pageDots" : false}'>

                                    @foreach (json_decode($d->images, true) as $image)
                                        <img src="{{ asset('/storage/products/images/' . $image) }}"
                                            class="w-25 img-thumbnail"
                                            onclick="changeImage('{{ asset('/storage/products/images/' . $image) }}')"
                                            alt="">
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="card-detail-product py-4 px-4 mt-4">
                                <div class="product-name ms-2 ps-2 mt-3">
                                    {{ $d->title }}
                                </div>

                                <div class="price-product mt-lg-2 ms-2 ps-2 ">@currency($d->price)</div>

                                @if ($d->stock > 10)
                                    <div class="stock-product mt-lg-2 ms-2 ps-2">Stok : {{ $d->stock }}</div>
                                @else
                                    <div class="stock-product mt-lg-2 ms-2 ps-2 text-danger">Stok : {{ $d->stock }}
                                    </div>
                                @endif

                                <div class="stock-product mt-lg-2 ms-2 ps-2">Berat : {{ $d->weight }} gram</div>

                                <div class="desc-product mt-3 px-3">
                                    {{ $d->desc }}
                                </div>

                                <div class="chose-size mt-3 px-3">
                                    Quantity :
                                </div>
                                <livewire:cart.counter-barang :maxProduct="$d" />

                                @php
                                    $pilihan = json_decode($d->pilihan);
                                @endphp
                                @if ($pilihan != null)
                                    <div class="chose-size mt-3 px-3">
                                        Colors/Type :
                                    </div>

                                    <div class="container mt-3 px-3">
                                        @forelse ($pilihan as $pil)
                                            @foreach ($pil as $p)
                                                <label class="me-3 col-md mb-2 mr-2" for="{{ $p }}">
                                                    <input class="d-none b" type="radio" id="{{ $p }}"
                                                        name="pilihanSelected" value="{{ $p }}" required>
                                                    <div class="detail-size-card justify-content-center">
                                                        <div class="text-size m-0">{{ $p }}</div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        @empty
                                            <h5>Tidak ada ukuran yang tersedia</h5>
                                        @endforelse
                                    </div>
                                @endif

                                @php
                                    $ukuranConvert = json_decode($d->size);
                                @endphp
                                @if ($ukuranConvert != null)
                                    <div class="chose-size mt-3 px-3">
                                        Size :
                                    </div>

                                    <div class="container mt-3 px-3">
                                        @forelse ($ukuranConvert as $u)
                                            @foreach ($u as $a)
                                                <label class="me-3 col-md mb-2 mr-2" for="{{ $a }}">
                                                    <input class="d-none b" type="radio" id="{{ $a }}"
                                                        name="sizeSelected" value="{{ $a }}" required>
                                                    <div class="detail-size-card">
                                                        <div class="text-size m-0">{{ $a }}</div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        @empty
                                            <h5>Tidak ada ukuran yang tersedia</h5>
                                        @endforelse
                                    </div>
                                @endif


                                @if (Auth::user())
                                    <button type="submit" class="btn btn-add-cart d-inline-block w-100 p-2 mt-4">
                                        Add to cart
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="btn btn-add-cart d-inline-block w-100 p-2 mt-4">
                                        Add to cart
                                    </a>
                                @endif

                            </div>
                        </div>

                        {{-- <div class="col-md-12 ">
                            <div class="card-detail-product py-4 px-4 mt-4">
                                <div class="product-name ms-2 ps-2 mt-3">
                                    {{ $d->title }}
                                </div>

                                <button type="submit" class="btn btn-add-cart d-inline-block w-100 p-2 mt-4">
                                    Add to cart
                                </button>
                            </div>
                        </div> --}}

                        <style>
                            .detail-product .card-detail-product {
                                box-shadow: 0px 4px 40px rgba(172, 172, 172, 0.15);
                                border-radius: 15px;
                                background-color: #ffffff;
                            }

                            .detail-product .card-detail-product .product-name {
                                font: 600 1.50rem/1.90rem "Poppins", sans-serif;
                            }

                            .detail-product .card-detail-product .desc-product {
                                color: #ADB2B8;
                            }

                            .detail-product .card-detail-product .price-product {
                                font: 500 1.25rem/1.90rem "Poppins", sans-serif;
                                color: #121213;
                            }

                            .detail-product .card-detail-product .stock-product {
                                font: 400 1rem/1.90rem "Poppins", sans-serif;
                            }

                            .detail-product .card-detail-product .btn-add-cart {
                                background-color: var(--dull-purple);
                                color: #fff;
                                font: 600 1rem/1.90rem "Poppins", sans-serif;
                            }

                            .detail-product input[type="radio"]:checked+.detail-size-card {
                                border: 2px solid var(--dull-purple);
                                color: var(--dull-purple);
                                min-width: 5rem;
                                padding: 2.5px !important;
                                text-align: center;
                                background-color: rgba(0, 186, 255, 0.05);
                            }

                            .detail-product .detail-size-card {
                                border: 2px solid #000000;
                                border-radius: 6px;
                                min-width: 5rem;
                                padding: 2.5px !important;
                                text-align: center;
                                font-size: 17px;
                            }

                            /* .detail-product .detail-size-card #icon-check{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                transition: all 0.1s linear;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                opacity: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            .detail-product input[type="radio"]:checked+.detail-size-card #icon-check{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                opacity: 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

                        </style>
                    </div>
                </div>
            </section>
        </form>

        @php
            $getId = $d->id_product;
        @endphp
    @endforeach

    <section class="related-product w-100 h-100">
        <div class="container px-4">
            @if (count($dataAll) >= 2)
                <div class="caption-related-product ps-3">
                    Explore Our Product
                </div>
                <div class="carousel pt-2"
                    data-flickity='{ "cellAlign": "left", "contain": true, "groupCells": true, "wrapAround": false, "prevNextButtons": false, "draggable": true, "pageDots" : false}'>

                    @foreach ($dataAll as $all)
                        @if ($all->id_product != $getId)
                            <div class="card-related-carousel">
                                @php
                                    $property_images = json_decode($all->images);
                                @endphp
                                <div class="image-placeholder">
                                    <img src="{{ asset('/storage/products/images/' . $property_images[0]) }}"
                                        alt="images" />
                                </div>

                                <div class="card-details">
                                    <a href="{{ route('detail.show', $all->id_product) }}"
                                        style="text-decoration: none;">
                                        <div class="caption">{{ $all->title }}</div>
                                    </a>
                                </div>


                                <div class="bottom-text d-flex flex-row justify-content-between">
                                    <div class="price-content flex-grow-1">
                                        <span class="price">@currency($all->price)</span>
                                    </div>
                                    {{-- <div class="rating d-flex align-items-center">
                                    <img src="https://api.elements.buildwithangga.com/storage/files/2/assets/Header/Header-House/star-yellow.svg"
                                        alt="star" />
                                    <span></span>
                                </div> --}}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <style>
            .related-product .caption-related-product {
                font: 600 1.50rem/1.90rem "Poppins", sans-serif;
            }

            .related-product .card-related-carousel {
                width: 325px;
                padding: 28px 28px 40px;
                border-radius: 28px;
                background: white;
                -webkit-box-shadow: 20px 8px 18px rgba(178, 177, 255, 0.05);
                box-shadow: 20px 8px 18px rgba(178, 177, 255, 0.05);
            }

            @media only screen and (max-width: 768px) {
                .related-product .card-related-carousel {
                    margin-right: 20px;
                }
            }

            .related-product .card-related-carousel .image-placeholder {
                width: 268px;
                height: 190px;
            }

            .related-product .card-related-carousel .image-placeholder img {
                width: 100%;
                height: 100%;
                -o-object-fit: cover;
                object-fit: cover;
                border-radius: 16px;
            }

            .related-product .card-related-carousel .card-details {
                height: 70px;
            }

            .related-product .card-related-carousel .card-details .caption {
                font-weight: 700;
                font-size: 24px;
                color: #080E09;
                margin-top: 24px;
            }

            .related-product .card-related-carousel .card-details .sub-caption {
                font-weight: 400;
                color: #ADB2B8;
            }

            .related-product .card-related-carousel .bottom-text .price-content {
                color: #080E09;
                font-size: 16px;
            }

            .related-product .card-related-carousel .bottom-text .price-content span {
                font-weight: 400;
            }

            .related-product .card-related-carousel .bottom-text .price-content span.price {
                font-weight: 700;
            }

            .related-product .card-related-carousel .bottom-text .rating {
                font-weight: 700;
                font-size: 16px;
                color: #FF9900;
            }

            .related-product .card-related-carousel .bottom-text .rating img {
                margin-top: -1px;
                margin-right: 5px;
            }

        </style>

        <script>
            function changeImage(imgName) {
                image = document.getElementById('imgDisp');
                image.src = imgName;
            }
        </script>
    </section>

    {{-- Footer --}}
    @include('includes.Frontend.footer')
@endsection
