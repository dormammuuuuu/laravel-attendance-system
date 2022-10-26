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
        <div class="table-container">
            {{ Breadcrumbs::render('master-list', $subject) }}
            @livewire('professor.manage-class', [$subject->id])
        </div>
    </div>
@endsection