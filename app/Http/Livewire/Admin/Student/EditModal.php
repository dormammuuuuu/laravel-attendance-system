<?php

namespace App\Http\Livewire\Admin\Student;

use App\Http\Livewire\Admin\StudentPagination;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    public User $user;
    public $firstname;
    public $lastname;
    public $middleinitial;
    public $section;
    public $student_no;

    public function update()
    {
        $this->validate([
            'firstname' => 'required|min:3|max:30',
            'middleinitial' => 'required|min:1|max:1',
            'lastname' => 'required|min:3|max:30',
            'student_no' => 'required|min:3|max:30|unique:users,student_no, ' . $this->user->id . ',id',
            'section' => 'required|min:3|max:30',
        ]);

        $this->user->update([
            'firstname' => $this->firstname,
            'middleinitial' => $this->middleinitial,
            'lastname' => $this->lastname,
            'student_no' => $this->student_no,
            'section' => $this->section,
        ]);

        $this->closeModalWithEvents([
            StudentPagination::getName() => 'refreshStudents'
        ]);
    }

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
        return view('livewire.admin.student.edit-modal');
    }
}
