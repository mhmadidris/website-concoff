@extends('layouts.app')

@section('title', ' Laporan')

@section('content')

    <form action="{{ route('dashboard.laporan.create') }}" method="POST">
        @csrf
        @method('GET')
        <livewire:laporan.laporan />
    </form>

@endsection
