<div>
    <x-loading-screen />
    <div class="profile-paginate">
        <p class="label">Class list</p>
        {{ $classes->links() }}
    </div>

    <div class="class-card-container @if($classes->count() != 0) pro @endif">
        @if($classes->count() == 0)
            {{-- display no class available --}}
            <div class="empty">
                <img src="{{ asset('img/empty.png') }}" alt="" srcset="">
                <p>No class found</p>
            </div>
        @else
            @foreach ($classes as $class)
                <x-class-card :class="$class" param="/admin/classes/"/>
            @endforeach
        @endif  
    </div>

</div>
