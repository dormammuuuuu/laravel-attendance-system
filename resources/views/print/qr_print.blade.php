<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}
    {{-- <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/print.css') }}"> --}}

    <style>
        @font-face {
            font-family: 'Poppins';
            src: url({{ storage_path('fonts\Poppins-Light.ttf') }}) format("truetype");
            font-weight: 400; 
            font-style: normal;
        }

        @font-face {
            font-family: 'PoppinsMedium';
            src: url({{ storage_path('fonts\Poppins-Medium.ttf') }}) format("truetype");
            font-weight: 500; 
            font-style: normal;
        }

        @font-face {
            font-family: 'PoppinsBold';
            src: url({{ storage_path('fonts\Poppins-Bold.ttf') }}) format("truetype");
            font-weight: 600; 
            font-style: normal;
        }

        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    
    <div id="qr-id" style="width: 204px; padding-top: 75px; height: 324px;    border-radius: 5px;    box-shadow: 0 0 10px rgba(0,0,0,0.2);    max-width: 300px;    width: 100%;    text-align: center;    height: 500px;    display: flex;    flex-direction: row;    justify-content: space-evenly;    align-items: center;    background-image: url({{$data->bg}});    background-size: cover;    background-position: center right;    background-repeat: no-repeat;">
    <div class="qr-image" style="padding: 10px;    border-radius: 10px;    width: 200px; margin:auto;   background-color: white;">
        <img src="data:image/png;base64, {{ base64_encode(QrCode::size(200)->generate($data->token)) }} ">
    </div>
    <div class="qr-details">
        <p style="font-size: 20px;    font-weight: 700;    color: white;    letter-spacing: 2px;    margin-bottom: 10px;" class="student-number">{{$data->student_no}}</p>
        <p style="font-family: 'Poppins'; font-size: 16px;    font-weight: 600;    color: white;    letter-spacing: 1px;" class="student-name">{{$data->lastname}}, {{$data->firstname}} {{$data->middleinitial}}.</p>
        <p style="font-family: 'Poppins'; font-size: 14px;    font-weight: 500;    color: white;    letter-spacing: 1px;" class="student-section">{{$data->section}}</p>
    </div>
</div>
</body>
</html>

