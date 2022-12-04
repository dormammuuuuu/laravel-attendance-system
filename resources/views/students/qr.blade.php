@extends('./layouts.main')

@section('title', 'Student QR Code')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/qr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/index.js') }}"></script>
@endsection    

@section('content')
    <x-navbar.index-navbar>
        <x-slot name="links">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{ route('index') }}" class="nav__link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="#about" class="nav__link">About</a>
                </li>
            </ul>
        </x-slot>
    </x-navbar.index-navbar>
    <div class="wrapper">
        <div id="qr-container">
            <div id="qr-card">
                <div class="qr-image">
                    {{ QrCode::size(200)->generate($data->student_no) }}
                </div>
                <div class="qr-details">
                    <p class="student-number">{{$data->student_no}}</p>
                    <p class="student-name">{{$data->lastname}}, {{$data->firstname}} {{$data->middleinitial}}</p>
                    <p class="student-section">{{$data->section}}</p>
                </div>
            </div>
            {{-- <button class="download-button" target="_" href="/student/{{$data->token}}/qrcode/download"> DOWNLOAD QR CODE</button> --}}
            <button class="download-button" onclick="Livewire.emit('openModal', 'student.terms', {{ json_encode([$data->token]) }})"> DOWNLOAD QR CODE</button>
        </div>
    </div>
    <x-footer.index-footer/>
@endsection