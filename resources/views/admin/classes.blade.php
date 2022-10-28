@extends('./layouts.main')

@section('title', 'Admin | Class')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/classCard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection

@php
    $firstname = auth()->user()->firstname;
    $lastname = auth()->user()->lastname;
    $middleinitial = auth()->user()->middleinitial;
@endphp

@section('content')
    <x-sidebar.sidebar firstname="{{$firstname}}" lastname="{{$lastname}}" middleinitial="{{$middleinitial}}">
        <x-sidebar.admin-sidebar/>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="Class" />
        <div class="action-container">
            {{ Breadcrumbs::render('classes') }}
            {{-- <button class="styled-button" onclick="Livewire.emit('openModal', 'professor.create-class')"><i class='bx bx-plus'></i> Create Class</button> --}}
        </div>
        @livewire('admin.display-class')
    </div>
@endsection