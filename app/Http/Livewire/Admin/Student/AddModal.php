<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\User;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class AddModal extends ModalComponent
{
    public User $user;
    public $firstname;
    public $middleinitial;
    public $lastname;
    public $student_no;
    public $section;
    public $tracks = ['ICT 11-A', 'ICT 11-B', 'ICT 12-A', 'ICT 12-B', 'GAS 11-A', 'GAS 11-B', 'GAS 12-A', 'GAS 12-B', 'HUMSS 11-A', 'HUMSS 11-B', 'HUMSS 12-A', 'HUMSS 12-B', 'STEM 11-A', 'STEM 11-B', 'STEM 12-A', 'STEM 12-B', 'ABM 11-A', 'ABM 11-B', 'ABM 12-A', 'ABM 12-B', 'SPORT 11-A', 'SPORT 11-B', 'SPORT 12-A', 'SPORT 12-B'];

    protected $rules = [
        'firstname' => 'required|min:3|max:30',
        'middleinitial' => 'required|min:1|max:1',
        'lastname' => 'required|min:3|max:30',
        'student_no' => 'required|min:3|max:30|unique:users,student_no',
        'section' => 'required|min:3|max:30',
    ];

    protected $validationAttributes = [
        'firstname' => 'first name',
        'middleinitial' => 'middle initial',
        'lastname' => 'last name',
        'student_no' => 'student number',
        'section' => 'section',
    ];

    public function create()
    {
        $validatedData = $this->validate();
        
        $data = [
            'firstname' => $validatedData['firstname'],
            'middleinitial' => $validatedData['middleinitial'],
            'lastname' => $validatedData['lastname'],
            'student_no' => $validatedData['student_no'],
            'section' => $validatedData['section'],
            'role' => 'student',
            'token' => Str::random(20),
        ];


        User::create($data);
        $this->closeModal();
        return redirect(request()->header('Referer'))->with('success', 'Student added successfully!');
    }


    public function render()
    {
        return view('livewire.admin.student.add-modal', [
            'tracks' => $this->tracks,
        ]);
    }
}
