<?php

namespace App\Http\Livewire\Professor;

use App\Models\User;
use Livewire\Component;
use App\Models\Classroom;
use App\Models\ClassStudent;
use Livewire\WithPagination;

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
