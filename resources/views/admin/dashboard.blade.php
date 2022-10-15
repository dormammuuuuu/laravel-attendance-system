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
        <div class="group">
            <ul>
                <x-sidebar.sidebar-item href="{{route('admin.dashboard')}}" icon="bx bxs-dashboard" title="Dashboard"/>
            </ul>
            <x-sidebar.sidebar-content-header title="Manage"/>
            <ul>
                <x-sidebar.sidebar-item href="{{route('admin.registrations')}}" icon="bx bxs-user-plus" title="Registration Request"/>
                <x-sidebar.sidebar-item href="{{route('admin.professors')}}" icon="bx bxs-user" title="Professor"/>
                <x-sidebar.sidebar-item href="{{route('admin.students')}}" icon="bx bxs-book" title="Student"/>
            </ul>
        </div>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="Dashboard"/>
        <div class="prof-class">
            <div class="subject-card-container">
                <x-subject.dashboard-card label="Professors" count="{{$prof}}" icon="bx bx-user" style="red"/>
                <x-subject.dashboard-card label="Students" count="{{$student}}" icon="bx bx-book-open"/>
                <x-subject.dashboard-card label="Classes" count="{{$class}}" icon="bx bx-book-alt"/>
            </div>
            <div>
                <x-action-card label="Professors" desc="Browse and manage the list of professors who are currently registered." link="{{route('admin.professors')}}"/>
                <x-action-card label="Students" desc="Browse and manage the list of students who are currently registered." link="{{route('admin.students')}}"/>
                <x-action-card label="Pending Registration" desc="Accept or reject registration requests. (Professors)" link="{{route('admin.registrations')}}"/>
            </div>
        </div>
    </div>

@endsection

@section('wow')
​We are raising money for one of our friend who has a cyst located at the left part of his stomach. His name is Ramino Santos. he is currently at the last year of college at Technological University of the Philippines. He has dreams that he wanted to fulfill someday. He was sick for almost a year and his eyes were already turning yellow. We will use the funds that we can get here for his operations, laboratory tests, medications, and many more. 
@endsection