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
            src: url({{ storage_path('fonts/Poppins-Light.ttf') }}) format("truetype");
            font-weight: 400; 
            font-style: normal;
        }

        @font-face {
            font-family: 'PoppinsMedium';
            src: url({{ storage_path('fonts/Poppins-Medium.ttf') }}) format("truetype");
            font-weight: 500; 
            font-style: normal;
        }

        @font-face {
            font-family: 'PoppinsBold';
            src: url({{ storage_path('fonts/Poppins-Bold.ttf') }}) format("truetype");
            font-weight: 600; 
            font-style: normal;
        }

        p{
            font-family: 'PoppinsMedium', sans-serif;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    
    <div id="qr-id" style="min-width: 200px; max-width: 300px; padding-top: 20px; height: 375px;    border-radius: 5px;    box-shadow: 0 0 10px rgba(0,0,0,0.2); text-align: center;  display: flex;    flex-direction: row;    justify-content: space-evenly;    align-items: center;  border: 1px solid #000; border-radius: 5px">
        <div class="qr-image" style="padding: 20px 10px;    padding-bottom: 15px; border-radius: 10px;   margin:auto;   background-color: white;">
            <img src="data:image/png;base64, {{ base64_encode(QrCode::size(220)->generate($data->student_no)) }} ">
        </div>
        <div class="qr-details">
            <p style="font-family: 'PoppinsBold', sans-serif; font-size: 22px;    font-weight: 600;    color: #00204a ;letter-spacing: 2px;">{{$data->student_no}}</p>
            <p style="font-size: 16px;    color: #00204a; font-weight: 500;    letter-spacing: 1px;">{{$data->lastname}}, {{$data->firstname}} {{$data->middleinitial}}</p>
            <p style="font-size: 14px;    color: #00204a; font-weight: 400;    letter-spacing: 1px;">{{$data->section}}</p>
        </div>
    </div>
</body>
</html>

