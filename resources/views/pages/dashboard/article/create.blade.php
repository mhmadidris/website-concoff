@extends('layouts.app')

@section('title', ' Add Voucher')

@section('content')

<main class="h-full overflow-y-auto">
    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-12">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    Add Voucher
                </h2>
            </div>
        </div>
    </div>

    <!-- breadcrumb -->
    <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">
            <li class="flex items-center">
                <a href="{{ URL('/dashboard/article') }}" class="text-gray-400">Voucher</a>
                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <p class="font-medium">Add New Voucher</p>
            </li>
        </ol>
    </nav>

    <section class="container px-6 mx-auto mt-5">
        <div class="grid gap-5 md:grid-cols-12">
            <main class="col-span-12 p-4 md:pt-0">
                <div class="px-2 py-2 mt-2 bg-white rounded-xl">

                    <form action="{{ route('dashboard.article.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    {{-- Title Headline --}}
                                    <div class="col-span-6">
                                        <label for="title" class="block mb-3 font-medium text-gray-700 text-md">Voucher
                                            Title</label>

                                        <input placeholder="Headline your article" maxlength="50" type="text" name="headline" id="headline" autocomplete="off" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ old('headline') }}">
                                        <div id="the-count" style="float: right; padding-top: 0.5em;">
                                            <span id="current">0</span>
                                            <span id="maximum">/ 50</span>
                                        </div>

                                        @if ($errors->has('headline'))
                                        <p class="text-red-500 mb-3 text-sm">{{ $errors->first('title') }}</p>
                                        @endif

                                    </div>

                                    {{-- Coin --}}
                                    <div class="col-span-6">
                                        <label for="title" class="block mb-3 font-medium text-gray-700 text-md">Coins</label>

                                        <input placeholder="Number of coins" type="number" min="0" name="coins" id="coins" autocomplete="off" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ old('coins') }}">

                                    </div>

                                    {{-- Valid Date --}}
                                    <div class="col-span-6">
                                        <label for="title" class="block mb-3 font-medium text-gray-700 text-md">Valid Date</label>

                                        <input type="date" name="validDate" id="validDate" autocomplete="off" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ old('validDate') }}">

                                    </div>

                                    {{-- Description --}}
                                    <div class="col-span-6">
                                        <label for="desc" class="block mb-3 font-medium text-gray-700 text-md">Description</label>
                                        <textarea name="desc" id="desc" placeholder="Description of voucher" cols="30" rows="10" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ old('desc') }}"></textarea>

                                        @if ($errors->has('desc'))
                                        <p class="text-red-500 mb-3 text-sm">{{ $errors->first('desc') }}</p>
                                        @endif
                                    </div>

                                    {{-- Terms & Condition --}}
                                    <div class="col-span-6">
                                        <label for="terms" class="block mb-3 font-medium text-gray-700 text-md">Terms & Condition</label>
                                        <textarea name="terms" id="terms" placeholder="Terms of the voucher" cols="30" rows="10" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ old('terms') }}"></textarea>

                                        @if ($errors->has('terms'))
                                        <p class="text-red-500 mb-3 text-sm">{{ $errors->first('terms') }}</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="flex mt-6">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="unggulanCheck" value="1" class="form-checkbox"
                                                style="border-radius: 20%; outline: none !important; box-shadow:none !important;">
                                            <span class="ml-2">Jadikan Produk Unggulan</span>
                                        </label>
                                    </div> --}}

                            </div>

                            <div class="px-4 py-3 text-right sm:px-6">
                                <a href="{{ route('dashboard.article.index') }}" type="button" class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300" onclick="return confirm('Are you sure want to cancel? , Any changes you make will not be saved.')">
                                    Cancel
                                </a>

                                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="return confirm('Are you sure want to submit this data ?')">
                                    Create Voucher
                                </button>
                            </div>

                        </div>
                    </form>

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
    $('#headline').keyup(function() {

        var characterCount = $(this).val().length
            , current = $('#current')
            , maximum = $('#maximum')
            , theCount = $('#the-count');

        current.text(characterCount);
    });

</script>

<script type="text/javascript">
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            view.src = URL.createObjectURL(file)
        }
    };

    photos.onchange = evt => {
        const [file] = photos.files
        if (file) {
            output.src = URL.createObjectURL(file)
        }
    };

</script>
@endpush
