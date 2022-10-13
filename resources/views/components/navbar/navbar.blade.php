@props([
    'title' => 'title',
])

<div id="nav">
    <div class="left">
        <i onclick="toggleSidebar()" class='bx bx-menu toggle bx-sm'></i>
        <h3>{{ $title }}</h3>
    </div>
    <div class="right">
        <a class="logout" href="{{ route('auth.logout') }}"><i class='bx bx-log-out bx-sm'></i></a>
    </div>
</div>