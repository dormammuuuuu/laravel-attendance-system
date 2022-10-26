<?php

namespace App\Http\Livewire\Qr;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Classroom;
use App\Models\ClassAttendance;

class QrLive extends Component
{
    public $qrlive;
    public $subject;
    public $firstname = "";
    public $lastname = "";
    public $middleinitial = "";
    public $student_no = "";
    public $show = "";

    protected $rules = [
        'qrlive' => 'required',
    ];

    protected $validationAttributes = [
        'qrlive' => 'QR Code or Student number',
    ];

    public function qrCode(){
        $this->firstname = "";
        $this->lastname = "";
        $this->middleinitial = "";
        $this->student_no = "";
        $this->show = "";
        $this->validate();
        
        $data = [
            'student_token' => $this->qrlive,
            'class_token' => $this->subject,
            'attendance_day' => now()->format('Y-m-d'),
        ];


        $user = User::where('student_no', $data['student_token'])->first();
        
        if (!$user){
            $this->addError('qrlive', 'User not found');
            return;
        }

        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->middleinitial = $user->middleinitial;
        $this->student_no = $user->student_no;
        $qr_student_section = $user->section;

        $validateSection = Classroom::where([
            'class_token' => $data['class_token'],
            'class_section' => $qr_student_section,
        ])->first();

        if (!$validateSection){
            $this->addError('qrlive', 'You are not allowed to attend this class');
            return;
        }

        $this->show = "show";
        if ($user) {

            $test = ClassAttendance::where([
                ['student_token', $this->qrlive],
                ['class_token', $this->subject],
                ['attendance_day', Carbon::now()->format('Y-m-d')],
            ])->first();

            if ($test) {
                $this->addError('qrlive', 'Student already scanned');
            } else {       
                ClassAttendance::create($data); 
            }
    
        } else {
            $this->addError('qrlive', 'QR Code or Student number is invalid.');
        }
        $this->qrlive = '';        
    }

    public function mount($token){
        $this->subject = $token;
    }


    public function render()
    {
        return view('livewire.qr.qr-live');
    }
}
