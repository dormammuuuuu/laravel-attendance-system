@props([
    'label' => 'label',
    'desc' => 'desc',
    'token' => 'token'
])

<button onclick="Livewire.emit('openModal', 'professor.start-session', {{ json_encode([$token]) }})">
    <div class="action-card">
        <div>
            <p class="title">{{$label}}</p>
            <p class="description">{{$desc}}</p>    
        </div>
        <i class='bx bx-chevron-right'></i>            
    </div>
</button>
