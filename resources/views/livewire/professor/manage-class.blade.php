<div>
    <div class="search-container">
        <div class="button-container">
            <button class="export" wire:click="exportMasterList">Export Master List</button>
        </div>
        <input wire:model="search" type="text" name="search" id="search" placeholder="Search...">    
    </div>
    <table>      
        <thead>
            <th sortable wire:click="sortBy('student_no')">Student Number <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('lastname')">Name <i class='bx bxs-sort-alt'></i></th>
            <th sortable>Days Present</th>
            <th sortable>Days Absent</th>
            <th sortable>Days Late</th>
            <th sortable>Days Excused</th>
            <th>Actions</th>
        </thead>
        <tbody> 
            @if ($data->count() == 0)
            <tr>
                <td colspan="4">No users to display.</td>
            </tr>
            @endif

            @php
                $sessions = App\Models\ClassSession::where('class_token', $classToken)->get()->count();
            @endphp

            @foreach ($data as $user)
                @php
                    $pattern = '/\s*\(.*\)/';
                    $present = App\Models\ClassAttendance::where([
                        'student_token' => preg_replace($pattern, '', $user->student_no),
                        'class_token' => $classToken,
                        'status' => 'present'
                    ])->get()->count();

                    $late = App\Models\ClassAttendance::where([
                        'student_token' => preg_replace($pattern, '', $user->student_no),
                        'class_token' => $classToken,
                        'status' => 'late'
                    ])->get()->count();

                    $excused = App\Models\ClassAttendance::where([
                        'student_token' => preg_replace($pattern, '', $user->student_no),
                        'class_token' => $classToken,
                        'status' => 'excused'
                    ])->get()->count();

                    $absent = $classSessionCount - ($present + $late + $excused);
                @endphp
                <tr>
                    <td data-label="Student number">{{ preg_replace($pattern, '', $user->student_no) }}</td>
                    <td data-label="Name">{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middleinitial }}</td>
                    <td data-label="Days Present">{{ $present }}</td>
                    <td data-label="Days Absent" class="{{ ($absent >= 3) ? "warning" : "" }}">{{ $absent }}</td>
                    <td data-label="Days Late">{{ $late }}</td>
                    <td data-label="Days Excused">{{ $excused }}</td>
                    <td data-label="Action" data-token="{{ $user->token }}">
                        <button class="action view" wire:click="$emit('openModal', 'professor.view-modal', {{ json_encode([$user->id]) }})">View</button>
                    </td>
                </tr>
            @endforeach
            <tr class="footer">
                <td colspan="2">
                    Displaying {{$data->count()}} of {{ $data->total() }} user(s).
                </td>
                <td colspan="3">
                    {{ $data->links() }}
                </td>
            </tr>
        </tbody>
    </table>
</div>