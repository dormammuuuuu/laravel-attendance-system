@props([
    'href' => 'href',
    'icon' => 'icon',
    'title' => 'title',
])

<li>
    <a href="{{$href}}" class="item"><i class='{{$icon}}'></i>{{$title}}</a>
</li>
