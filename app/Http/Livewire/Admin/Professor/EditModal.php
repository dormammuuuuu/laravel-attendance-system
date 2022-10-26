<?php

namespace App\Http\Livewire\Admin\Professor;

use App\Http\Livewire\Admin\ProfessorPagination;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    public User $user;
    public $firstname;
    public $lastname;
    public $middleinitial;
    public $username;

    public function update(){
        $this->validate([
            'firstname' => 'required|min:3|max:30',
            'middleinitial' => 'required|min:1|max:1',
            'lastname' => 'required|min:3|max:30',
            'username' => 'required|min:3|max:30|unique:users,username, ' . $this->user->id . ',id',
            'email' => 'required|email|unique:users,email, ' . $this->user->id . ',id',
        ]);

        $this->user->update([
            'firstname' => $this->firstname,
            'middleinitial' => $this->middleinitial,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
        ]);

        $this->closeModalWithEvents([
            ProfessorPagination::getName() => 'refreshProfessors'
        ]);
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->middleinitial = $user->middleinitial;
        $this->email = $user->email;
        $this->username = $user->username;
    }

    public function render()
    {
        return view('livewire.admin.professor.edit-modal');
    }
}
