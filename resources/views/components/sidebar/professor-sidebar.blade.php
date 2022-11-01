<div class="group">
    @if(auth()->user()->role == 'admin')
        <ul>
            <x-sidebar.sidebar-item href="{{route('admin.dashboard')}}" icon="bx bxs-dashboard" title="Admin Dashboard"/>
        </ul>
    @endif
    <x-sidebar.sidebar-content-header title="Manage"/>
    <ul>
        <x-sidebar.sidebar-item href="{{route('professors.dashboard')}}" icon="bx bxs-chalkboard" title="My Class"/>
        <x-sidebar.sidebar-item href="{{route('professors.account')}}" icon="bx bxs-cog" title="Account Settings"/>

    </ul>
</div>