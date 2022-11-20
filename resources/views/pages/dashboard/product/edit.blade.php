@extends('layouts.app')

@section('title', ' Edit Product')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit Your Product
                    </h2>
                    <p class="text-sm text-gray-400">
                        Let's update the our product
                    </p>
                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">
                <li class="flex items-center">
                    <a href="{{ URL('/dashboard/product') }}" class="text-gray-400">Product</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <p class="font-medium">Update Data Product</p>
                </li>
            </ol>
        </nav>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        @foreach ($editData as $d)
                            <form action="{{ route('dashboard.product.update', $d->id_product) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">

                                            <div class="col-span-6">
                                                <label for="title" class="block mb-3 font-medium text-gray-700 text-md">Name
                                                    Product</label>

                                                <input value="{{ $d->title }}" maxlength="100" type="text" name="name"
                                                    id="name" autocomplete="off"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    value="{{ old('name') }}" required>
                                                <div id="the-count" style="float: right; padding-top: 0.5em;">
                                                    <span id="current">0</span>
                                                    <span id="maximum">/ 100</span>
                                                </div>

                                                @if ($errors->has('name'))
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}</p>
                                                @endif

                                            </div>


                                            <div class="col-span-6">
                                                <label for="price"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Price</label>

                                                <input value="{{ $d->price }}" type="number" name="price" id="price"
                                                    autocomplete="price"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    value="{{ old('price') }}" required>

                                                @if ($errors->has('price'))
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('price') }}</p>
                                                @endif
                                            </div>

                                            <div class="col-span-6">
                                                <label for="thumbnail-service"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Thumbnail Product
                                                    Feeds</label>

                                                <style>
                                                    .grid-wrapper {
                                                        --auto-grid-min-size: 10rem;
                                                        display: grid;
                                                        grid-gap: 2rem;
                                                        grid-template-columns: repeat(auto-fill, minmax(var(--auto-grid-min-size), 1fr));
                                                        margin: 0;
                                                        padding: 0;
                                                        box-sizing: border-box;
                                                        font-family: 'Montserrat', sans-serif;

                                                    }

                                                    .grid-wrapper li {
                                                        color: #ffffff;
                                                        font-size: 24px;
                                                        list-style-type: none;
                                                        margin: auto;
                                                        text-align: center;
                                                        text-transform: capitalize;
                                                        font-weight: 600;
                                                        overflow: hidden;

                                                    }

                                                    .main-container {
                                                        margin: 0 auto;
                                                        max-width: 1170px;
                                                    }

                                                </style>

                                                <div class="p-2">
                                                    <div class="w-50 p-3" style="background-color: #eee;">
                                                        <h5>Gambar yang disimpan:</h5>
                                                        @if ($d->images != null)
                                                            <div class="row flex">
                                                                <div class="main-container">
                                                                    <ul class="grid-wrapper">
                                                                        @foreach (json_decode($d->images, true) as $i)
                                                                            <li>
                                                                                <img src="{{ asset('/storage/products/images/' . $i) }}"
                                                                                    class="img-thumbnail p-1" alt=""
                                                                                    style="width: 100%; border-radius: 5%;">
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>


                                                <img src="{{ asset('assets/images/empty-illustration.svg') }}" id="output"
                                                    style="width: 25%; padding-top: 1.5%; padding-bottom: 1.5%;" />
                                                <input placeholder="Thumbnail 1" value="{{ $d->images }}" type="file"
                                                    name="photos[]" id="photos" autocomplete="photos"
                                                    onchange="loadFile(event)"
                                                    class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">

                                                @if ($errors->has('photos[]'))
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('photos') }}
                                                    </p>
                                                @endif

                                                <div id="newThumbnailRow"></div>

                                                <button type="button"
                                                    class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                    id="addThumbnailRow">
                                                    Tambahkan Gambar +
                                                </button>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="desc"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Description</label>
                                                <textarea name="desc" id="desc" cols="30" rows="10" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    value="{{ old('desc') }}">{{ $d->desc }}</textarea>

                                                @if ($errors->has('desc'))
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('desc') }}</p>
                                                @endif
                                            </div>


                                            <div class="col-span-6">
                                                <label for="weight"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Weight
                                                    (gram)</label>
                                                <input type="number" name="weight" id="weight" autocomplete="weight"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    value="{{ $d->weight }}">

                                                @if ($errors->has('weight'))
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('weight') }}
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="col-span-6">
                                                <label for="stock"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Stock</label>
                                                <input placeholder="Tambah Minimum Order" type="number" name="stock"
                                                    id="stock" autocomplete="stock"
                                                    class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                    value="{{ $d->stock }}">

                                                @if ($errors->has('stock'))
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('stock') }}
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="col-span-6">
                                                <label for="pilihan"
                                                    class="block mb-3 font-medium text-gray-700 text-md">Color /
                                                    Type (optional)</label>

                                                {{-- @if ($d->pilihan != null)
                                                    <div class="p-2">
                                                        <div class="w-50 p-3" style="background-color: #eee;">
                                                            <h5>Ukuran yang tersedia:</h5>
                                                            @foreach (json_decode($d->pilihan, true) as $p)
                                                                @if ($p != null)
                                                                    @foreach ($p as $i)
                                                                        <h1>- {{ $i }}</h1>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif --}}

                                                @if ($d->pilihan != null)
                                                    @foreach (json_decode($d->pilihan, true) as $p)
                                                        @for ($i = 0; $i < count($p); $i++)
                                                            <input placeholder="Warna / Tipe" type="text" name="pilihan[]"
                                                                id="pilihan" autocomplete="pilihan"
                                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                                value="{{ $p[$i] }}">
                                                        @endfor
                                                    @endforeach
                                                @else
                                                    <input placeholder="Warna / Tipe" type="text" name="pilihan[]"
                                                        id="pilihan" autocomplete="pilihan"
                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                        value="">
                                                @endif

                                                <div id="newPilihan"></div>

                                                <button type="button"
                                                    class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                    id="addPilihan">
                                                    Tambahkan Pilihan Yang Tersedia +
                                                </button>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="size" class="block mb-3 font-medium text-gray-700 text-md">Size
                                                    (optional)</label>

                                                {{-- @if ($d->size != null)
                                                    <div class="p-2">
                                                        <div class="w-50 p-3" style="background-color: #eee;">
                                                            <h5>Ukuran yang tersedia:</h5>
                                                            @foreach (json_decode($d->size, true) as $u)
                                                                @foreach ($u as $i)
                                                                    <h1>- {{ $i }}</h1>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif --}}

                                                @if ($d->size != null)
                                                    @foreach (json_decode($d->size, true) as $u)
                                                        @for ($i = 0; $i < count($u); $i++)
                                                            <input placeholder="Size" type="text" name="size[]" id="size"
                                                                autocomplete="size"
                                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                                value="{{ $u[$i] }}">
                                                        @endfor
                                                    @endforeach
                                                @else
                                                    <input placeholder="Size" type="text" name="size[]" id="size"
                                                        autocomplete="size"
                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                        value="">
                                                @endif

                                                <div id="newAdvantagesRow"></div>

                                                <button type="button"
                                                    class="inline-flex justify-center px-3 py-2 mt-3 text-xs font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                                                    id="addAdvantagesRow">
                                                    Tambahkan Size Yang Tersedia +
                                                </button>
                                            </div>
                                        </div>

                                        {{-- @php
                                            dd($d->unggulan);
                                        @endphp --}}

                                        <div class="flex mt-6">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="unggulanCheck" value="1" class="form-checkbox"
                                                    style="border-radius: 20%; outline: none !important; box-shadow:none !important;"
                                                    @if ($d->unggulan != null) checked @endif>
                                                <span class="ml-2">Jadikan Produk Unggulan</span>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="px-4 py-3 text-right sm:px-6">
                                        <a href="{{ route('dashboard.product.index') }}" type="button"
                                            class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                                            onclick="return confirm('Are you sure want to cancel? , Any changes you make will not be saved.')">
                                            Cancel
                                        </a>

                                        <button type="submit"
                                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                            onclick="return confirm('Are you sure want to submit this data ?')">
                                            Update Product
                                        </button>
                                    </div>

                                </div>
                            </form>
                        @endforeach
                    </div>
                </main>
            </div>
        </section>
    </main>

@endsection

@push('after-script')
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>

    <script type="text/javascript">
        // Count Char
        $('#name').keyup(function() {

            var characterCount = $(this).val().length,
                current = $('#current'),
                maximum = $('#maximum'),
                theCount = $('#the-count');

            current.text(characterCount);
        });
    </script>

    <script type="text/javascript">
        // add row
        $("#addPilihan").click(function() {
            var html = '';
            html +=
                '<input placeholder="Warna / Tipe" type="text" name="pilihan[]" id="pilihan" autocomplete="pilihan" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" >';

            $('#newPilihan').append(html);
        });

        $("#addAdvantagesRow").click(function() {
            var html = '';
            html +=
                '<input placeholder="Size" type="text" name="size[]" id="size" autocomplete="size" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">';

            $('#newAdvantagesRow').append(html);
        });

        $("#addThumbnailRow").click(function() {
            var html = '';
            html +=
                ' <input placeholder="Keunggulan 3" onchange="loadFile(event)" type="file" name="photos[]" id="photos" autocomplete="photos" class="block w-full py-3 pl-5 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" required>'
            $('#newThumbnailRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeAdvantagesRow', function() {
            $(this).closest('#inputFormAdvantagesRow').remove();
        });

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endpush
