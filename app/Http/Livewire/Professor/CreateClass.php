<?php

namespace App\Http\Livewire\Professor;

use App\Models\Classroom;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class CreateClass extends ModalComponent
{
    public $class_name;
    public $class_room;
    public $class_section;

    public function createClass(){
        $this->validate([
            'class_name' => 'required',
            'class_room' => 'required',
            'class_section' => 'required',
        ]);

        $data = [
            'class_name' => $this->class_name,
            'class_room' => $this->class_room,
            'class_section' => $this->class_section,
            'class_prof' => auth()->user()->token,
            'class_token' => Str::random(20),
        ];

        Classroom::create($data);
        $this->closeModal();
        return redirect(request()->header('Referer'))->with('success', 'Class created successfully!');
    }

    public function render()
    {
        return view('livewire.professor.create-class');
    }
}
