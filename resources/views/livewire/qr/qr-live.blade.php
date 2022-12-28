<div class="scanner-dashboard">
    <div class="scanner-cam">
        <div class="scanner-container">
            <video id="preview"></video>
            <form wire:submit.prevent="qrCode" method="POST">
                <div class="qr-form">
                    <input class="field" placeholder="Student number" type="text" name="qr-live" id="qr-live" wire:model.defer="qrlive">
                    <input class="submit" type="submit" value="Submit" id="submit-live">
                    @error('qrlive')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </form>    
        </div>
        {{-- 9781-84668-BL-3 --}}
        <div class="user-info {{$show}}">
            <p class="{{$status}}" style="max-width: 100%">Status: {{ ucfirst($status) }}</p>
            <p class="heading">User details</p> 
            <p>Student number: <span class="detail">{{$student_no}}</span></p>
            <p>Full name: <span class="detail">{{$lastname}}, {{$firstname}} {{$middleinitial}}</span></p>
        </div>
    </div>
    <div class="list">
        <h1 class="heading">List of students</h1>
        @foreach ($data as $user)
            @php
                $attendance = \App\Models\ClassAttendance::where([
                    'student_token' =>   $user->student_no,
                    'class_token' => $subject,
                    'attendance_day' => \Carbon\Carbon::now()->format('Y-m-d'),
                ])->first();
            @endphp
            <div class="item">
                <div>
                    <p>{{$user->lastname}}, {{$user->firstname}} {{ ($user->middleinitial) ? $user->middleinitial . '.' : ''}}</p>
                    <p class="student-number">{{substr($user->student_no, 0, 4) . str_repeat('*', 5) . substr($user->student_no, -4)}}</p>
                </div>
                <div class="action">
                    @if (!$attendance)
                        <i wire:click="excused({{$user->id}})" title="Excuse this student" class='bx bx-exclude'></i>
                    @endif
                    <p title="Wow" class="status {{($attendance) ? ucfirst($attendance->status) : "Absent"}}">{{ ($attendance) ? ucfirst($attendance->status) : "Absent"}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

