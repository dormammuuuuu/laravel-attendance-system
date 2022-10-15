@props([
    'title' => 'title',
])

<div id="nav">
    <div class="left">
        <i onclick="toggleSidebar()" class='bx bx-menu toggle bx-sm'></i>
        <h3>{{ $title }}</h3>
    </div>
</div>