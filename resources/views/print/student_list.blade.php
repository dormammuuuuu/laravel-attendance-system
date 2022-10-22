<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

        table{
            width: 100%;
            border-collapse: collapse;
        }
        .table thead th{
            text-align: left;
            padding: 10px;
            background: #00204a;
            color: white;
        }

        .table tbody tr td{
            padding: 10px;

        }

        .table tbody tr:nth-child(even){
            background: #f2f2f2;
        }

        .details{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="details">
        <table>
            <tr>
                <td>ADMIN EXCLUSIVE EXPORT</td>
                <td>Date: {{$date}}</td>
            </tr>
            <tr>
                <td>Admin: {{auth()->user()->lastname}}, {{auth()->user()->firstname}} {{auth()->user()->middleinitial}}</td>
            </tr>
        </table>
    </div>
    <table class="table">      
        <thead>
            <th>Student Number</th>
            <th>Name</th>
            <th>Section</th>
        </thead>
        <tbody>
            @foreach ($data as $user)
                <tr>
                    <td>{{$user->student_no}}</td>
                    <td>{{$user->lastname}}, {{$user->firstname}} {{$user->middleinitial}}</td>
                    <td>{{$user->section}}</td>
                </tr>
                {{-- <tr>
                    <td>{{ $user['student_no'] }}</td>
                    <td>{{ $user['lastname'] }}, {{ $user['firstname'] }} {{ $user['middleinitial'] }}</td>
                    <td>{{ $user['section'] }}</td>
                </tr> --}}
            @endforeach
        </tbody>
    </table>
</body>
</html>

