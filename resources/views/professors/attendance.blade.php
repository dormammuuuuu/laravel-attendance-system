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
        <div class="table-container">
            @livewire('professor.attendance-view', [$subject->id])
        </div>
    </div>
@endsection