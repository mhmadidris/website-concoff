@extends('layouts.front')

@section('title', ' Home')

@section('content')

{{-- Navigation bar --}}
@include('includes.Frontend.navbar')

<section>

    <img class="" src="{{ asset('concoff/Banner_contoh.svg') }}" width="100%;" />

    <div class="container">

        <div class="card" style="width: 18rem;">
            <img src="{{ asset('concoff/Rectangle 10.jpg') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>

</section>

{{-- Footer --}}
@include('includes.Frontend.footer')
@endsection
