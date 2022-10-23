<div>
    <div class="search-container">
        <div class="button-container">
            <button class="export" wire:click="exportIndividual">Export Today</button>
            <button class="export" wire:click="exportWeekly">Export Weekly</button>
            <a class="export" href="/professor/class/{{$classToken}}/calendar/{{$classDate}}/export">Export All</a>
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
                    <td data-label="Student number">{{ $user->student_no }}</td>
                    <td data-label="Name">{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middleinitial }}</td>
                    <td data-label="Section">{{ $user->section }}</td>
                    <td data-label="Status" data-token="{{ $user->token }}">
                        @php
                            $attendance = App\Models\ClassAttendance::where([
                                'student_token' => $user->student_no,
                                'attendance_day' => $classDate,
                                'class_token' => $classToken
                            ])->first();   

                            if ($attendance) {
                                echo '<span class="present">Present</span>';
                            } else {
                                echo '<span class="absent">Absent</span>';
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