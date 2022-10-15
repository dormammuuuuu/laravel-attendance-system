<?php

namespace App\Http\Controllers;

use \PDF;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }
    
    public function store(Request $request)
    {
        $studentNumber = $request->input('StudentNumber');
        $data = User::where('student_no', $studentNumber)->first();
        if($data){
            $token = $data->token;
            return redirect('/student/'.$token.'/qrcode');
        }

        $request->validate([
            'FirstName' => 'required|max:30|min:2',
            'LastName' => 'required|max:30|min:2',
            'MiddleInitial' => 'required|max:1|min:1',
            'Course' => 'required|max:30|min:2',
            'StudentNumber' => 'required|max:30|min:2|unique:users,student_no',
        ]);

        $token = Str::random(20);

        $user = ([
            'firstname' => $request->FirstName,
            'lastname' => $request->LastName,
            'middleinitial' => $request->MiddleInitial,
            'student_no' => $request->StudentNumber,
            'section' => $request->Course,
            'token' => $token
        ]);

        User::create($user);

        return redirect('/student/'.$token.'/qrcode');
    }

    public function destroy($token)
    {
        $user = User::where('token', $token)->first();
        $user->delete();
        return redirect()->back()->with('success', 'Student Deleted');;
    }

    public function show($token)
    {
        $data = User::where('token', $token)->first();
        return view('students.qr', compact('data'));
    }

    public function download($token)
    {
        $data = User::where('token', $token)->first();
        $bg = file_get_contents(public_path('img/id_bg.jpg'));
        $base64 = 'data:image/jpg;base64,' . base64_encode($bg);
//        dd($base64);
        $data->bg = $base64;
        $pdf = PDF::loadView('print.qr_print', compact('data'));

        $customPaper = array(0,0,360, 504);

        $pdf->setPaper($customPaper);
        $pdf->render();
        return $pdf->stream('qr_code.pdf');
    }

}
