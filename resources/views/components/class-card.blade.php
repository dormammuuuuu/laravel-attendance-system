@props([
    'class' => 'class',
    'param' => 'param',
])

@php
    $tmp = $class->class_prof;
    $prof = \App\Models\User::withTrashed()->where('token', $tmp)->first();
    $firstname = $prof->firstname;
    $lastname = $prof->lastname;
    $middleinitial = $prof->middleinitial;
@endphp

<a href="{{$param}}{{$class->class_token}}" class="class-card">
    <p class="subject name">{{$class->class_name}}</p>
    <p class="subject room">Room number: {{$class->class_room}}</p>
    <p class="subject section">Section: {{$class->class_section}}</p>
    <p class="subject sy">School Year: {{$class->class_school_year}}</p>
    <p class="subject days">Schedule: {{$class->class_days}}</p>
    <p class="subject time">Time: {{ \Carbon\Carbon::parse($class->class_start_time)->format('h:i A')}} - {{\Carbon\Carbon::parse($class->class_end_time)->format('h:i A')}}</p>
    @if($param == "/admin/classes/")
        <p class="subject prof">Professor: {{$firstname}} {{$middleinitial}}. {{$lastname}}</p>
    @endif
</a>