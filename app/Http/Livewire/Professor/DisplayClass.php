<?php

namespace App\Http\Livewire\Professor;

use Livewire\Component;
use App\Models\Classroom;

class DisplayClass extends Component
{
    public $listeners = ['refreshDashboard' => 'render'];

    public function render()
    {
        return view('livewire.professor.display-class', [
            'classes'=> Classroom::where('class_prof', auth()->user()->token)->get(),
            'param' =>  '/professor/class/',
        ]);
    }
}
