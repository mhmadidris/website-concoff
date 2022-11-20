@extends('layouts.app')

@section('title', ' Voucher Preview')

@section('content')

<main class="h-full overflow-y-auto">
    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-12">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    Show Article
                </h2>
            </div>
        </div>
    </div>

    <!-- breadcrumb -->
    <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">
            <li class="flex items-center">
                <a href="{{ URL('/dashboard/article') }}" class="text-gray-400">Article</a>
                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <p class="font-medium">Show Article</p>
            </li>
        </ol>
    </nav>

    <section class="container px-6 py-4 mx-auto mt-5">
        @foreach ($articles as $at)
        <div class="bg-white rounded-lg overflow-hidden shadow-lg">
            <img class="w-full" src="{{ asset('/storage/articles/images/' . json_decode($at->image, true)) }}" alt="Image">
            <div class="px-6 py-4">
                {{-- Title Header --}}
                @if ($at->title_header != null)
                <div class="font-bold text-xl mb-2">
                    {{ $at->title_header }}
                </div>
                @endif

                {{-- Logo Header --}}
                @if ($at->logo_header != null)
                <img class="w-24 mb-2" src="{{ asset('/storage/articles/logo/' . json_decode($at->logo_header, true)) }}" alt="Logo Header">
                @endif

                <p class="text-gray-700 text-base">
                    {{ $at->desc }}
                </p>
            </div>
        </div>
        @endforeach
    </section>
</main>

@endsection
