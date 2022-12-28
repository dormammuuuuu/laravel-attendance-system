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

        .none{
            background: darkgray;
            width: 100%;
            height: 100%;
        }

        .absent{
            color: red;
        }

        .present{
            color: green;
        }

        .late {
            color: orange;
        }
    </style>
</head>
<body>
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
        </table>
    </div>
    <table class="table">      
        <thead>
            <th>Student Number</th>
            <th>Name</th>
            @php 
                $initial_date = \Carbon\Carbon::now()->subDays(6);
                $period = \Carbon\CarbonPeriod::create($initial_date, $date);
                $dates = $period->toArray();
                $date_array = [];
                foreach ($dates as $tmp){
                    $date_array[] = $tmp->format('Y-m-d');
                }
                $date_array[6] = $date;
            @endphp
            @foreach ($date_array as $date)
                <th>{{ \Carbon\Carbon::parse($date)->format('M d') }}</th>
            @endforeach
        </thead>
        <tbody> 
            @foreach ($data as $user)
                <tr>
                    <td>{{ preg_replace('/\s*\(.*\)/', '', $user['student_no']) }}</td>
                    <td>{{ $user['lastname'] }}, {{ $user['firstname'] }} {{ $user['middleinitial'] }}</td>                  

                    @foreach ($date_array as $date)
                        <td>
                            @php
                                $verifier = App\Models\ClassSession::where([
                                    'class_token' => $token,
                                    'class_date' => $date
                                ])->first();

                                if ($verifier){
                                    $attendance = App\Models\ClassAttendance::where([
                                        'student_token' => preg_replace('/\s*\(.*\)/', '', $user['student_no']),
                                        'attendance_day' => $date,
                                        'class_token' => $token
                                    ])->first();   

                                    if ($attendance) {
                                        if ($attendance->status == 'present'){
                                            echo '<div class="present">Present</div>';
                                        } else if ($attendance->status == 'excused'){
                                            echo '<div class="excused">Excused</div>';
                                        } else {
                                            echo '<div class="late">Late</div>';
                                        }
                                    } else {
                                        echo '<div class="absent">Absent</div>';
                                    }
                                }  else {
                                    echo '<span class="none"></span>';
                                }
                                
                            @endphp
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

