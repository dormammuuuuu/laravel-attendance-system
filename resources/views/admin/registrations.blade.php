@extends('./layouts.main')

@section('title', 'Admin | Registrations')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
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
        <div class="group">
            <ul>
                <x-sidebar.sidebar-item href="{{route('admin.dashboard')}}" icon="bx bxs-dashboard" title="Dashboard"/>
                <x-sidebar.sidebar-item href="{{route('professors.dashboard')}}" icon="bx bxs-dashboard" title="Prof. Dashboard"/>
            </ul>
            <x-sidebar.sidebar-content-header title="Manage"/>
            <ul>
                <x-sidebar.sidebar-item href="{{route('admin.registrations')}}" icon="bx bxs-user-plus" title="Registration Request"/>
                <x-sidebar.sidebar-item href="{{route('admin.professors')}}" icon="bx bxs-user" title="Professor"/>
                <x-sidebar.sidebar-item href="{{route('admin.students')}}" icon="bx bxs-book" title="Student"/>
                <x-sidebar.sidebar-item href="{{route('admin.classes')}}" icon="bx bx-chalkboard" title="Class"/>
            </ul>
        </div>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="Approve registration" />
        <div class="table-container">
            @livewire('admin.user-pagination')
        </div>
    </div>
@endsection