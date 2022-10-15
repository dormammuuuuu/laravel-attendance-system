@props([
    'firstname' => 'firstname',
    'lastname' => 'lastname',
    'middleinitial' => 'middleinitial'
])

<div id="sidebar">
    <div class="sidebar-header">
        <h1>ASHMR</h1>
    </div>
    <ul class="sidebar-content">
        {{$slot}}
    </ul>
    <div class="bottom">
        <p class="name">{{$lastname}}, {{$firstname}} {{$middleinitial}}.</p>
        <a href="{{route('auth.logout')}}" class="logout-btn">
            <i class='bx bx-log-out'></i>
            <span>Logout</span>
        </a>
    </div>
</div>