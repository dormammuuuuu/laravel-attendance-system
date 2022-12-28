<div>
    <div class="search-container">
        <div class="button-container">
            <button class="export" wire:click="$emit('openModal', 'professor.export-attendance-modal', {{ json_encode([$classToken, $classDate]) }})">Export Attendance</button>
        </div>
        <input wire:model="search" type="text" name="search" id="search" placeholder="Search...">    
    </div>
    <table>      
        <thead>
            <th sortable wire:click="sortBy('student_no')">Student Number <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('lastname')">Name <i class='bx bxs-sort-alt'></i></th>
            <th sortable wire:click="sortBy('section')">Year & Section <i class='bx bxs-sort-alt'></i></th>
            <th>Status</th>
        </thead>
        <tbody> 
            @if ($data->count() == 0)
            <tr>
                <td colspan="4">No users to display.</td>
            </tr>
            @endif
            @foreach ($data as $user)
                <tr>
                    <td data-label="Student number">{{ preg_replace('/\s*\(.*\)/', '', $user->student_no) }}</td>
                    <td data-label="Name">{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middleinitial }}</td>
                    <td data-label="Section">{{ $user->section }}</td>
                    <td data-label="Status" data-token="{{ $user->token }}">
                        @php
                            $pattern = '/\s*\(.*\)/';
                            $attendance = App\Models\ClassAttendance::where([
                                'student_token' => preg_replace($pattern, '', $user->student_no),
                                'attendance_day' => $classDate,
                                'class_token' => $classToken
                            ])->first();   

                            if ($attendance) {
                                if ($attendance->status == 'present'){
                                    echo '<div class="present">Present</div>';
                                } else if ($attendance->status == 'excused'){
                                    echo '<div class="excused">Excused</div>';
                                } else {
                                    echo '<div class="late">Late</div>';
                                }
                            } else {
                                echo '<div class="absent">Absent</div>';
                            }
                        @endphp
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