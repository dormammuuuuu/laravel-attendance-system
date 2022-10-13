<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class ViewModal extends ModalComponent
{

    public User $user;
    public $firstname;
    public $lastname;
    public $middleinitial;
    public $section;
    public $student_no;

    public function mount(User $user)
    {

        $this->user = $user;
        $this->student_no = $user->student_no;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->middleinitial = $user->middleinitial;
        $this->section = $user->section;
    }

    public function render()
    {
        return view('livewire.admin.student.view-modal');
    }
}
