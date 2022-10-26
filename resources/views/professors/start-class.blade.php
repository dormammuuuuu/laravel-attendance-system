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

@section('qr-cam')
    <script type="text/javascript" src="{{ asset('js/qr/instascan.min.js') }}"></script>
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
        <x-navbar.navbar title="Session: {{$subject->class_name}} | {{ $subject->class_section }}" />
        {{-- <div class="session-breadcrumbs">
            {{ Breadcrumbs::render('professor-session', $subject) }}
        </div> --}}
        <livewire:qr.qr-live :token="$token" />
    </div>
    <script type="text/javascript">
        const qr_live = document.getElementById('qr-live');
        const submit_live = document.getElementById('submit-live');
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            qr_live.value = content;
            qr_live.dispatchEvent(new Event('input'));
            submit_live.click();
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>
@endsection