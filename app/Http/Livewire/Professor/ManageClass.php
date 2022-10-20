<?php

namespace App\Http\Livewire\Professor;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use \PDF;
use App\Models\Classroom;
use App\Models\ClassStudent;
use Livewire\WithPagination;

class ManageClass extends Component
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

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        } 
    }

    public function exportMasterList(){
        $class_section = $this->classSection;
        $subject = Classroom::where('class_token', $this->classToken)->first()->class_name;
        $tmp_prof = Classroom::where('class_token', $this->classToken)->first()->class_prof;
        $tmp = User::where('token', $tmp_prof)->first();
        $professor_name = $tmp->firstname . ' ' . $tmp->lastname;
        $date = Carbon::now()->format('F d, Y');
        $token = $this->classToken;
        $data = User::where([
            'section' => $this->classSection,
            'role' => 'student'
        ])->orderBy('lastname', 'asc')->get()->toArray();
        $pdfContent = PDF::loadView('print.master_list', compact('data', 'token', 'professor_name', 'class_section', 'date', 'subject'))->output();

        return response()->streamDownload(
             fn () => print($pdfContent),
             "master_list.pdf"
        );
    }

    public function render()
    {
        return view('livewire.professor.manage-class', [
            'data' => User::where('section', $this->classSection)
            ->search([
                'student_no',
                'firstname',
                'lastname',
                'section',
            ], $this->search)
            
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10)
        ]);
    }
}
