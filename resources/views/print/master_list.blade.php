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
    @php
        $sessions = App\Models\ClassSession::where('class_token', $token)->get()->count();
    @endphp
    <div class="details">
        <table>
            <tr>
                <td>Subject: {{$subject}}</td>
                <td>Professor: {{$professor_name}}</td>
            </tr>
            <tr>
                <td>Section: {{$class_section}}</td>
                <td>Date: {{$date}}</td>
            </tr>
            <tr>
                <td>Number of Sessions: {{$sessions}}</td>
                <td>School Year: {{$school_year}}</td>
            </tr>
        </table>
    </div>
    <table class="table">      
        <thead>
            <th>Student Number</th>
            <th>Name</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Late</th>
            <th>Excused</th>
        </thead>
        <tbody> 
            
            @foreach ($data as $user)
                @php
                    $pattern = '/\s*\(.*\)/';
                    $present = App\Models\ClassAttendance::where([
                        'student_token' => preg_replace($pattern, '', $user['student_no']),
                        'class_token' => $token,
                        'status' => 'present'
                    ])->get()->count();

                    $late = App\Models\ClassAttendance::where([
                        'student_token' => preg_replace($pattern, '', $user['student_no']),
                        'class_token' => $token,
                        'status' => 'late'
                    ])->get()->count();

                    $excused = App\Models\ClassAttendance::where([
                        'student_token' => preg_replace($pattern, '', $user['student_no']),
                        'class_token' => $token,
                        'status' => 'excused'
                    ])->get()->count();

                    $absent = $sessions - ($present + $late + $excused);
                @endphp
                <tr>
                    <td>{{ preg_replace('/\s*\(.*\)/', '', $user['student_no']) }}</td>
                    <td>{{ $user['lastname'] }}, {{ $user['firstname'] }} {{ $user['middleinitial'] }}</td>
                    <td>{{ $present }}</td>
                    <td>{{ $absent }}</td>
                    <td>{{ $late }}</td>
                    <td>{{ $excused }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

