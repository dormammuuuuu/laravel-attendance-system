@extends('./layouts.main')

@section('title')
    {{ $subject->class_name }} | {{ $subject->class_section }}
@endsection

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
        <div class="group">
            <ul>
                <x-sidebar.sidebar-item href="{{route('admin.dashboard')}}" icon="bx bxs-dashboard" title="Dashboard"/>
            </ul>
            <x-sidebar.sidebar-content-header title="Manage"/>
            <ul>
                <x-sidebar.sidebar-item href="{{route('admin.registrations')}}" icon="bx bxs-user-plus" title="Registration Request"/>
                <x-sidebar.sidebar-item href="{{route('admin.professors')}}" icon="bx bxs-user" title="Professor"/>
                <x-sidebar.sidebar-item href="{{route('admin.students')}}" icon="bx bxs-book" title="Student"/>
                <x-sidebar.sidebar-item href="{{route('admin.classes')}}" icon="bx bxs-book" title="Class"/>
            </ul>
        </div>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="ADMINISTRATOR | {{$subject->class_name}} | {{ $subject->class_section }}" />
        <div class="prof-class">
            <div class="subject-card-container">
                <x-subject.dashboard-card label="Students" count="{{$students}}" icon="bx bx-user" style="red"/>
                <x-subject.dashboard-card label="Days" count="{{$session}}" icon="bx bx-sun"/>
                <x-subject.dashboard-card label="Attendance Today" count="{{$attendance}}%" icon="bx bx-calendar"/>
            </div>
            <div>
                <x-action-card label="View List" desc="View full student list" link="/professor/class/{{$subject->class_token}}/manage"/>
                <x-action-card label="Attendance" desc="View student attendance" link="/professor/class/{{$subject->class_token}}/calendar"/>
                <x-action-card label="Delete" desc="This option will delete your class and all of its records. Delete at your own risk." link="/professor/class/{{$subject->class_token}}/delete"/>
            </div>
        </div>
    </div>
@endsection