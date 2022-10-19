@props([
    'class' => 'class',
    'param' => 'param',
])

@php
    $tmp = $class->class_prof;
    $prof = \App\Models\User::where('token', $tmp)->first();
    $firstname = $prof->firstname;
    $lastname = $prof->lastname;
    $middleinitial = $prof->middleinitial;
@endphp

<a href="{{$param}}{{$class->class_token}}" class="class-card">
    <p class="subject name">{{$class->class_name}}</p>
    <p class="subject room">Room number: {{$class->class_room}}</p>
    <p class="subject section">Section: {{$class->class_section}}</p>
    @if($param == "/admin/classes/")
        <p class="subject prof">Professor: {{$firstname}} {{$middleinitial}}. {{$lastname}}</p>
    @endif
</a>