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
        <x-sidebar.professor-sidebar/>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="{{$subject->class_name}} | {{ $subject->class_section }}" />
        <div class="prof-class">
            <div class="subject-card-container">
                <x-subject.dashboard-card label="Students" count="{{$students}}" icon="bx bx-user" style="red"/>
                <x-subject.dashboard-card label="Days" count="{{$session}}" icon="bx bx-sun"/>
                <x-subject.dashboard-card label="Attendance Today" count="{{$attendance}}%" icon="bx bx-calendar"/>
            </div>
            <div>
                <x-action-card target="" label="Start" desc="Start a session now." link="/professor/class/{{$subject->class_token}}/start"/>
                <x-action-card target="" label="View Class" desc="View the student list and export data, including the attendance for the entire semester." link="/professor/class/{{$subject->class_token}}/manage"/>
                <x-action-card target="" label="Calendar" desc="View student attendance at the calendar" link="/professor/class/{{$subject->class_token}}/calendar"/>
                <x-action-card target="" label="Delete" desc="This option will delete your class and all of its records. Delete at your own risk." link="/professor/class/{{$subject->class_token}}/delete"/>
            </div>
        </div>
    </div>
@endsection