<?php

namespace App\Http\Livewire\Professor;

use Carbon\Carbon;
use App\Models\ClassSession;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StartSession extends ModalComponent
{

    public $endTime;
    public $minutesSeekbar = 5;
    public $token;

    public function startSession(){
        $date = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('H:i:s');
        ClassSession::create([
            'class_token' => $this->token,
            'class_date' => $date,
            'class_start_time' => $time,
            'class_end_time' => Carbon::parse($time)->addHours($this->endTime)->format('H:i:s'),
            'class_late' => Carbon::parse($time)->addMinutes($this->minutesSeekbar)->format('H:i:s'),
        ]);
        $this->closeModal();
        $this->redirect('/professor/class/'. $this->token .'/start');
    }

    public function mount($token)
    {
        $this->token = $token;
        // try {
        //     $attempt = ClassSession::where([
        //         'class_token' => $this->token,
        //         'class_date' => Carbon::now()->format('Y-m-d'),
        //     ])->firstOrFail();            
        // } catch (ModelNotFoundException $e) {
        //     return 'Invalid Token';
        // }
        // if ($attempt) {
        //     $link = '/professor/class/'. $this->token .'/start';
        //     echo $link;
        //     return redirect()->to($link);
        // }
    }

    public function render()
    {
        return view('livewire.professor.start-session');
    }
}
