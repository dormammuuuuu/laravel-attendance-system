<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\User;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class AddModal extends ModalComponent
{
    public User $user;
    public $firstname;
    public $middleinitial;
    public $lastname;
    public $username;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'firstname' => 'required|min:3|max:30',
        'middleinitial' => 'required|min:1|max:1',
        'lastname' => 'required|min:3|max:30',
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
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'admin',
            'token' => Str::random(20),
            'approved' => 1,
        ];

        User::create($data);
        $this->closeModal();
        return redirect(request()->header('Referer'))->with('success', 'Admin account created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admins.add-modal');
    }
}