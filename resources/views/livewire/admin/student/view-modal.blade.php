<div>
    <div class="qr-card">
        <div class="qr-image">
            {{ QrCode::size(200)->generate($student_no) }}
        </div>
        <div class="qr-details">
            <p class="student-number">{{$student_no}}</p>
            <p class="student-name">{{$lastname}}, {{$firstname}} {{$middleinitial}}</p>
            <p class="student-section">{{$section}}</p>
        </div>
        <a target="_blank" class="qr-download" href="/student/{{$token}}/qrcode/download">Download Student QR Code</a>
    </div>
</div>
