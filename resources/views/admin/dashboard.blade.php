@extends('./layouts.main')

@section('title', 'Admin | Dashboard')

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
        <x-sidebar.admin-sidebar/>
    </x-sidebar.sidebar>
    <div id="main">
        {{-- <a href="{{route('maintenance.on')}}">ON</a>
        <a href="{{route('maintenance.off')}}">OFF</a> --}}
        <x-navbar.navbar title="Dashboard"/>
        <div class="prof-class">
            <div class="subject-card-container">
                <x-subject.dashboard-card label="Professors" count="{{$prof}}" icon="bx bx-user" style="red"/>
                <x-subject.dashboard-card label="Students" count="{{$student}}" icon="bx bx-book-open"/>
                <x-subject.dashboard-card label="Classes" count="{{$class}}" icon="bx bx-book-alt"/>
            </div>
            <div class="button-container">
                <x-action-card target="" label="Class" desc="Browse and manage the list of classes." link="{{route('admin.classes')}}"/>
                <x-action-card target="" label="Professors" desc="Browse and manage the list of professors who are currently registered." link="{{route('admin.professors')}}"/>
                <x-action-card target="" label="Archived Professors" desc="Browse and manage the list of archived professors who are registered." link="{{route('admin.archived')}}"/>
                <x-action-card target="" label="Students" desc="Browse and manage the list of students who are currently registered." link="{{route('admin.students')}}"/>
                {{-- <x-action-card target="" label="Pending Registration" desc="Accept or reject registration requests. (Professors)" link="{{route('admin.registrations')}}"/> --}}
            </div>
        </div>
    </div>
@endsection