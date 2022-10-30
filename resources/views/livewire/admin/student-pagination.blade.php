<div>
    <x-loading-screen />
    <div class="search-container">
        <div class="button-container">
            <button class="add" wire:click="$emit('openModal', 'admin.student.add-modal')">Add Student</button>
            <button class="export" wire:click="exportStudents">Export</button>
        </div>
        <div>
            <input wire:model="search" type="text" name="search" id="search" placeholder="Search...">    
            <button class="filter" wire:click="$emit('openModal', 'admin.student.search-filter')"><i class='bx bx-filter-alt'></i></button>
        </div>
    </div>
    <table>      
        <thead>
            <th sortable wire:click.defer="sortBy('student_no')">Student Number <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('lastname')">Name <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('section')">Year & Section <i class='bx bxs-sort-alt'></i></th>
            <th>Actions</th>
        </thead>
        <tbody> 
            @if ($data->count() == 0)
            <tr>
                <td colspan="4">No users to display.</td>
            </tr>
            @endif
            @foreach ($data as $user)
                <tr>
                    <td data-label="Student Number">{{ $user->student_no }}</td>
                    <td data-label="Name">{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middleinitial }}</td>
                    <td data-label="Section">{{ $user->section }}</td>
                    <td data-label="Action" data-token="{{ $user->token }}">
                        <button class="action view" wire:click="$emit('openModal', 'admin.student.view-modal', {{ json_encode([$user->id]) }})">View</button>
                        <button class="action edit" wire:click="$emit('openModal', 'admin.student.edit-modal', {{ json_encode([$user->id]) }})">Edit</button> 
                        <a class="action delete" href="/student/{{$user->token}}/delete">Delete</a>
                    </td>
                </tr>
            @endforeach
            <tr class="footer">
                <td colspan="1">
                    Displaying {{$data->count()}} of {{ $data->total() }} user(s).
                </td>
                <td colspan="3">
                    {{ $data->onEachSide(1)->links() }}
                </td>
            </tr>
        </tbody>
    </table>
</div>