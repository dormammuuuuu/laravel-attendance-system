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

@section('content')
    <x-sidebar.sidebar>
        <div class="group">
            <x-sidebar.sidebar-content-header title="Manage"/>
            <ul>
                <x-sidebar.sidebar-item href="{{route('professors.dashboard')}}" icon="bx bxs-user-plus" title="My Class"/>
                <x-sidebar.sidebar-item href="#" icon="bx bxs-user-plus" title="Attendance"/>
            </ul>
        </div>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="{{$subject->class_name}} | {{ $subject->class_section }}" />
        <div class="prof-class">
            <div class="subject-card-container">
                <x-subject.dashboard-card label="Students" count="0" icon="bx bx-user" style="red"/>
                <x-subject.dashboard-card label="Days" count="0" icon="bx bx-sun"/>
                <x-subject.dashboard-card label="Average Attendance" count="100%" icon="bx bx-calendar"/>
            </div>
            <div>
                <x-action-card label="Start" desc="Start a session now."/>
                <x-action-card label="Manage" desc="Add, update, or remove a student from your class." link="/professor/class/{{$subject->class_token}}/manage"/>
                <x-action-card label="Attendance" desc="View student attendance"/>
                <x-action-card label="Delete" desc="This option will delete your class and all of its records. Delete at your own risk." link="/professor/class/{{$subject->class_token}}/delete"/>
            </div>
        </div>
    </div>
@endsection