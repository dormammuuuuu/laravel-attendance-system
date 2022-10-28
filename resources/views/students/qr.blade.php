@extends('./layouts.main')

@section('title', 'Student QR Code')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/qr.css') }}">
@endsection

@section('js')
@endsection    

@section('content')
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
    <a class="download-button" target="_" href="/student/{{$data->token}}/qrcode/download"> DOWNLOAD QR CODE</a>
</div>
    
@endsection