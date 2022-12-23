<div class="group">
    <ul>
        <x-sidebar.sidebar-item href="{{route('admin.dashboard')}}" icon="bx bxs-dashboard" title="Dashboard"/>
        <x-sidebar.sidebar-item href="{{route('professors.dashboard')}}" icon="bx bxs-dashboard" title="Prof. Dashboard"/>
    </ul>
    <x-sidebar.sidebar-content-header title="Manage"/>
    <ul>
        <x-sidebar.sidebar-item href="{{route('admin.admins')}}" icon="bx bxs-diamond" title="Administrator"/>
        <x-sidebar.sidebar-item href="{{route('admin.classes')}}" icon="bx bxs-chalkboard" title="Class"/>
        <x-sidebar.sidebar-item href="{{route('admin.professors')}}" icon="bx bxs-user" title="Professor"/>
        <x-sidebar.sidebar-item href="{{route('admin.students')}}" icon="bx bxs-book" title="Student"/>
        <x-sidebar.sidebar-item href="{{route('admin.settings')}}" icon="bx bxs-cog" title="System Settings"/>
        {{-- <x-sidebar.sidebar-item href="{{route('admin.registrations')}}" icon="bx bxs-user-plus" title="Registration Request"/> --}}
    </ul>
</div>