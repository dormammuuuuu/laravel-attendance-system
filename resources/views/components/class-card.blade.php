@props([
    'class' => 'class'
])

<a href="/professor/class/{{$class->class_token}}" class="class-card">
    <p class="subject name">{{$class->class_name}}</p>
    <p class="subject room">Room number: {{$class->class_room}}</p>
    <p class="subject section">Section: {{$class->class_section}}</p>
</a>