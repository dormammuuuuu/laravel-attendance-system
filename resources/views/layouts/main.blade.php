<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite('resources/js/app.js')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href='{{ asset('css/boxicons.min.css')}}' rel='stylesheet'>
    
    <script defer src="{{ asset('js/admin/jquery-3.6.1.min.js') }}"></script>

    <!-- Alpine v3 -->
    <script defer src="{{ asset('js/admin/alpine.min.js') }}"></script>
    <script defer src="{{ asset('js/admin/alpine-focus.min.js') }}"></script>
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <!-- Focus plugin -->
    {{-- <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script> --}}
    @yield('js')
    @yield('qr-cam')
    @yield('css')
</head>
<body>
    @yield('content')
    @livewireScripts
    @livewireCalendarScripts
    @livewire('livewire-ui-modal')
</body>
</html>