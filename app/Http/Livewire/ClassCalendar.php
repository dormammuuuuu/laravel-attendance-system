<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classroom;
use App\Models\ClassSession;
use App\Models\ClassAttendance;
use Illuminate\Support\Collection;
use Asantibanez\LivewireCalendar\LivewireCalendar;

class ClassCalendar extends LivewireCalendar
{   
    public $token;

    public function events() : Collection
    {
        $this->token = request()->segment(3);

        return ClassSession::where('class_token', $this->token)
        ->whereDate('class_date', '>=', $this->gridStartsAt)
        ->whereDate('class_date', '<=', $this->gridEndsAt)
        ->get()
        ->map(function (ClassSession $class) {
            $perDay = ClassAttendance::where([
                'class_token' => $this->token, 
                'attendance_day' => $class->class_date])
                ->count();
            $tmp = Classroom::where('class_token', $this->token)->first();
            $section = User::where(['section' => $tmp->class_section, 'role' => "student"])->count();
            $percent = ($perDay / $section) * 100;

            return [
                'id' => $class->id,
                'title' => "Attendance",
                'description' => round($percent) . "%",
                'date' => $class->class_date,
            ];
        });
    }

    public function onEventClick($eventId)
    {
        $data = ClassSession::findOrfail($eventId);
        return redirect('/professor/class/' . $this->token . '/calendar/' . $data->class_date);
    }

    // public function render()
    // {
    //     return view('livewire.class-calendar');
    // }
}
