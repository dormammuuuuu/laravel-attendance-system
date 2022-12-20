@extends('./layouts.main')

@section('title', 'Admin | Archived')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/classCard.css') }}">
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
        <x-navbar.navbar title="Professor Profile" />
        <div class="profile-breadcrumbs">
            {{ Breadcrumbs::render('archived-profile', $user->lastname, $user->firstname, $user->middleinitial) }}
        </div>
        <div class="profile">
            <div class="details">
                <p class="profile-archived">This is an archived user</p>
                <p class="name">{{$user->lastname}}, {{$user->firstname}} {{$user->middleinitial}}</p>
                <p class="date">Joined on {{ \Carbon\Carbon::parse($user->created_at)->format('F d, Y')}}</p>
            </div>
            <hr>
            <livewire:admin.professor-class-pagination :token="$token"/>
        </div>
    </div>
@endsection