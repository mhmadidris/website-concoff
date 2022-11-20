<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>

    @include('includes.dashboard.meta')

    <title>@yield('title') | ConCoff</title>

    @stack('before-style')

    @include('includes.dashboard.style')

    @stack('after-style')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @livewireStyles

    {{-- Production --}}
    {{-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script> --}}

    {{-- SandBox --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <div class="flex h-screen bg-serv-services-bg" :class="{ 'overflow-hidden': isSideMenuOpen }">

        @include('components.dashboard.desktop')

        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 flex items-end bg-black bg-opacity-50 z-1 sm:items-center sm:justify-center"></div>

        @include('components.dashboard.mobile')

        <div class="flex flex-col flex-1 w-full">
            @include('components.dashboard.header')

            {{-- @include('sweetalert::alert') --}}

            @yield('content')
        </div>

    </div>

    @stack('before-script')

    @include('includes.dashboard.script')

    @stack('after-script')

    @livewireScripts

    @include('sweetalert::alert')
</body>

</html>
