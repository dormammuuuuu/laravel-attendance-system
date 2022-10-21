<div>
    <div class="search-container right">
        <input wire:model="search" type="text" name="search" id="search" placeholder="Search...">    
    </div>   
    <table>      
        <thead>
            <th sortable wire:click="sortBy('lastname')">Name <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('username')">Username <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('created_at')">Date Created <i class='bx bxs-sort-alt'></i></th>
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
                    <td>{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middleinitial }}</td>
                    
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->created_at }}</td> 
                    <td>
                        <a class="action reject" href="/admin/registrations/{{ $user->token }}/reject">Decline</a>
                        <a class="action approve" href="/admin/registrations/{{ $user->token }}/approve">Accept</a>
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
