<div>
    <div class="action-container bottom">
        <button class="styled-button" onclick="Livewire.emit('openModal', 'professor.create-class')"><i class='bx bx-plus'></i> Create Class</button>
        <select class="dashboard-sy-select" wire:model="schoolYear">
            <option value="all">All</option>
            @foreach ($sy as $year)
                <option value="{{$year->year}}" {{$loop->last ? 'selected' : ''}}>{{$year->year}}</option>    
            @endforeach
        </select>
    </div>
    <div class="class-card-container">
        @if($classes->count() > 0)
            @foreach($classes as $class)
                <x-class-card :class="$class" :param="$param"/>
            @endforeach
        @else
            <div class="empty">
                <img src="{{ asset('img/empty.png') }}" alt="" srcset="">
                <p>No class found</p>
            </div>
        @endif
    </div>
</div>