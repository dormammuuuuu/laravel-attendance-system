@extends('./layouts.main')

@section('title', 'Admin | Students')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection    

@section('content')
    <x-sidebar.sidebar>
        <div class="group">
            <x-sidebar.sidebar-content-header title="Manage"/>
            <ul>
                <x-sidebar.sidebar-item href="{{route('admin.registrations')}}" icon="bx bxs-user-plus" title="Registration Request"/>
                <x-sidebar.sidebar-item href="{{route('admin.professors')}}" icon="bx bxs-user" title="Professor"/>
                <x-sidebar.sidebar-item href="{{route('admin.students')}}" icon="bx bxs-book" title="Student"/>
            </ul>
        </div>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="Students" />
        <div class="table-container">   
            @livewire('admin.student-pagination')
        </div>

    </div>

    
@endsection