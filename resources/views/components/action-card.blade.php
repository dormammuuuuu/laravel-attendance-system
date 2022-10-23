@props([
    'label' => 'label',
    'desc' => 'desc',
    'link' => 'link',
    'target' => 'target'
])

<a href="{{$link}}" target="{{$target}}">
    <div class="action-card">
        <div>
            <p class="title">{{$label}}</p>
            <p class="description">{{$desc}}</p>    
        </div>
        <i class='bx bx-chevron-right'></i>            
    </div>
</a>
