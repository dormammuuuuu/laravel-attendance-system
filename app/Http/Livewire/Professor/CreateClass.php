<?php

namespace App\Http\Livewire\Professor;

use App\Models\User;
use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class CreateClass extends ModalComponent
{
    public $class_name;
    public $class_room;
    public $class_section;
    public $schoolYear;
    public $dropdown;

    public function updated($field){
        $this->validateOnly($field, [
            'class_name' => 'required|min:3|max:30',
            'class_room' => 'required|numeric',
            'class_section' => 'required',
        ]);
    }

    public function mount(){
        $this->dropdown = ['ICT 11-A', 'ICT 11-B', 'ICT 12-A', 'ICT 12-B', 'GAS 11-A', 'GAS 11-B', 'GAS 12-A', 'GAS 12-B', 'HUMSS 11-A', 'HUMSS 11-B', 'HUMSS 12-A', 'HUMSS 12-B', 'STEM 11-A', 'STEM 11-B', 'STEM 12-A', 'STEM 12-B', 'ABM 11-A', 'ABM 11-B', 'ABM 12-A', 'ABM 12-B', 'SPORT 11-A', 'SPORT 11-B', 'SPORT 12-A', 'SPORT 12-B'];
        $this->class_section = $this->dropdown[0];
        $this->schoolYear = SchoolYear::latest()->first()->year;
    }

    public function createClass(){
        $this->validate([
            'class_name' => 'required|min:3|max:30',
            'class_room' => 'required|numeric',
            'class_section' => 'required',
        ]);

        $data = [
            'class_name' => $this->class_name,
            'class_room' => $this->class_room,
            'class_section' => $this->class_section,
            'class_prof' => auth()->user()->token,
            'class_token' => Str::random(20),
            'class_school_year' => $this->schoolYear,
        ];

        Classroom::create($data);
        $this->closeModal();
        return redirect(request()->header('Referer'))->with('success', 'Class created successfully!');
    }

    public function updateSelect($data){
        $this->class_section = $data;
    }

    public function render()
    {
        return view('livewire.professor.create-class');
    }
}
