<?php

namespace App\Http\Livewire\Admin\Professor;

use App\Models\User;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class AddModal extends ModalComponent
{
    public User $user;
    public $firstname;
    public $middleinitial;
    public $lastname;
    public $email;
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'firstname' => 'required|min:3|max:30|alpha',
        'middleinitial' => 'min:0|max:1|alpha',
        'lastname' => 'required|min:3|max:30|alpha',
        'email' => 'required|email|unique:users,email',
        'username' => 'required|min:3|max:30|unique:users,username',
        'password' => 'required|min:3|max:30|confirmed',
    ];

    protected $validationAttributes = [
        'firstname' => 'first name',
        'middleinitial' => 'middle initial',
        'lastname' => 'last name',
        'username' => 'username',
        'password' => 'password',
    ];

    public function create()
    {
        $validatedData = $this->validate();

        $data = [
            'firstname' => $validatedData['firstname'],
            'middleinitial' => $validatedData['middleinitial'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'professor',
            'token' => Str::random(20),
            'approved' => 1,
        ];

        User::create($data);
        $this->closeModal();
        return redirect(request()->header('Referer'))->with('success', 'Professor added successfully!');
    }

    public function render()
    {
        return view('livewire.admin.professor.add-modal');
    }
}
