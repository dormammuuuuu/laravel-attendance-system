<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProfessorRegistrationForm extends Component
{
    public $firstname, $lastname, $middleinitial, $email, $Password, $Password_confirmation, $username;

    protected $rules = [
        'firstname' => 'required|max:30|min:2|alpha',
        'lastname' => 'required|max:30|min:2|alpha',
        'middleinitial' => 'max:1|min:0',
        'email' => 'required|email|unique:users,email',
        'username' => 'required|max:30|min:2|unique:users,username',
        'Password' => 'required|max:30|min:6|required_with:Password_confirmation|same:Password_confirmation',
        'Password_confirmation' => 'required|max:30|min:6',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.professor-registration-form');
    }
}
