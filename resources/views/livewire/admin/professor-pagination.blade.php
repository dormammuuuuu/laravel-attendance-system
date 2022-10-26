<div>
    <div class="search-container">
        <div class="button-container">
            <button class="add" wire:click="$emit('openModal', 'admin.professor.add-modal')">Add Professor</button>
        </div>
        <input wire:model="search" type="text" name="search" id="search" placeholder="Search...">    
    </div>   
    <table>      
        <thead>
            <th sortable wire:click="sortBy('lastname')">Name <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('username')">Username <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('email')">Email <i class='bx bxs-sort-alt'></i></th>
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
                    <td data-label="Name">{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middleinitial }}</td>
                    <td data-label="Username">{{ $user->username }}</td>
                    <td data-label="Email">{{ $user->email }}</td>
                    <td data-label="Action">
                        <a class="action view" href="/admin/professors/{{$user->token}}/view">View</a>
                        <button class="action edit" wire:click="$emit('openModal', 'admin.professor.edit-modal', {{ json_encode([$user->id]) }})">Edit</button>
                        <a class="action delete" href="/professor/{{$user->token}}/delete">Delete</a>
                    </td>
                </tr>
            @endforeach
            <tr class="footer">
                <td colspan="1">
                    Displaying {{$data->count()}} of {{ $data->total() }} user(s).
                </td>
            <td colspan="3">
                    {{ $data->links() }}
                </td>
            </tr>
        </tbody>
    </table>
</div>