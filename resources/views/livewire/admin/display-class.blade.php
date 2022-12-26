<div>
    <x-loading-screen />
    <div class="class-search">
        <input id="search" type="text" placeholder="Search" wire:model="search" >
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
    {{  $classes->links()  }}
</div>


