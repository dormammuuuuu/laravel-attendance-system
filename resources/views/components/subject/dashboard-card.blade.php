@props([
    'label' => 'label',
    'count' => 'count',
    'icon' => 'icon',
    'style' => 'style'
])

<div class="subject-card">
    <div>
        <p>{{$label}}</p>
        <p class="count">{{$count}}</p>    
    </div>
    <div class="icon {{$style}}">
        <i class="{{$icon}}"></i>
    </div>
</div>