<div>
    <div class="search-container">
        <div class="button-container">
            <button class="export">Export</button>
        </div>
        <input wire:model="search" type="text" name="search" id="search" placeholder="Search Student Number...">    
    </div>
    <table>      
        <thead>
            <th sortable wire:click="sortBy('student_no')">Student Number <i class='bx bxs-sort-alt'></i></th>
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
                    <td>{{ $user->student_no }}</td>
                    <td>{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middleinitial }}</td>
                    <td>{{ $user->section }}</td>
                    <td data-token="{{ $user->token }}">
                        ------------
                        {{-- <button class="action view">View</button>
                        <button class="action edit">Edit</button> 
                        <a class="action delete" href="/student/{{$user->token}}/delete">Delete</a> --}}
                    </td>
                </tr>
            @endforeach
            <tr class="footer">
                <td colspan="2">
                    Displaying {{$data->count()}} of {{ $data->total() }} user(s).
                </td>
                <td colspan="2">
                    {{ $data->links() }}
                </td>
            </tr>
        </tbody>
    </table>
</div>