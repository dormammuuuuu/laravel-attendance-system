<?php

namespace App\Http\Livewire\Professor;

use \PDF;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Classroom;
use App\Models\ClassStudent;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;

class AttendanceView extends Component
{
    use WithPagination;
    public ClassStudent $class;
    public $search = '';
    public $sortField = 'lastname';
    public $sortDirection = 'asc';
    public $classSection;
    public $classToken;

    public $listeners = ['refreshProfessors' => 'render'];

    public function paginationView()
    {
        return 'pagination::default';
    }

    public function mount(Classroom $class)
    {
        $this->classSection = $class->class_section;
        $this->classToken = $class->class_token;
    }

    public function exportIndividual(){
        $professor_name = auth()->user()->firstname . ' ' . auth()->user()->lastname;
        $class_section = $this->classSection;
        $subject = Classroom::where('class_token', $this->classToken)->first()->class_name;
        $date = Carbon::now()->format('Y-m-d');
        $token = $this->classToken;
        $data = User::where([
            'section' => $this->classSection,
            'role' => 'student'
        ])->orderBy('lastname', 'asc')->get()->toArray();
        $pdfContent = PDF::loadView('print.individual_attendance', compact('data', 'token', 'professor_name', 'class_section', 'date', 'subject'))->output();

        return response()->streamDownload(
             fn () => print($pdfContent),
             "individual_attendance.pdf"
        );
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        } 
    }

    public function render()
    {
        return view('livewire.professor.attendance-view', [
            'data' => User::where('section', $this->classSection)->orderBy($this->sortField, $this->sortDirection)->search('student_no', $this->search)->paginate(10)
        ]);
    }
}
