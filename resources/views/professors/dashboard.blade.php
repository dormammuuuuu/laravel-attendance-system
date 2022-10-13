@extends('./layouts.main')

@section('title', 'Professor | Dashboard')

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
                <x-sidebar.sidebar-item href="#" icon="bx bxs-user-plus" title="My Class"/>
                <x-sidebar.sidebar-item href="#" icon="bx bxs-user-plus" title="Attendance"/>
            </ul>
        </div>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="Dashboard" />
        <div class="action-container">
            <button class="styled-button" onclick="Livewire.emit('openModal', 'professor.create-class')"><i class='bx bx-plus'></i> Create Class</button>
        </div>
        @livewire('professor.display-class')
    </div>

@endsection