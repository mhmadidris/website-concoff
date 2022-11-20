<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('includes.meta')

    <title>@yield('title') | ConCoff</title>

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')

    <link rel="stylesheet" href="{{ asset('frontend/vendor/css/bootstrap.min.css') }}">

    @livewireStyles
</head>

<body>

    @yield('content')

    @stack('before-script')
    @include('includes.script')
    @stack('after-script')

    @livewireScripts

    @include('sweetalert::alert')
</body>

</html>
