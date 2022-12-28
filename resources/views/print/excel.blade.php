<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .present{
            color: greenyellow;
        }
        .absent{
            color: red;
        }

        td{
            text-align: center
        }
    </style>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th><strong>Student Name</strong></th>
            @foreach ($dates as $date)
                <th><strong>{{ \Carbon\Carbon::parse($date)->format('F d') }}</strong></th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{$student->lastname}}, {{$student->firstname}} {{$student->middleinitial}}</td>
                @foreach ($dates as $date)
                    <td>

                        @php
                            $attendance = App\Models\ClassAttendance::where([
                                'student_token' => preg_replace('/\s*\(.*\)/', '', $student->student_no),
                                'attendance_day' => $date,
                                'class_token' => $token
                            ])->first();   
        
                            if ($attendance) {
                                if ($attendance->status == 'present'){
                                    echo '<div class="present">P</div>';
                                } else if ($attendance->status == 'excused'){
                                    echo '<div class="excused">E</div>';
                                } else {
                                    echo '<div class="late">L</div>';
                                }
                            } else {
                                echo '<div class="absent">A</div>';
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