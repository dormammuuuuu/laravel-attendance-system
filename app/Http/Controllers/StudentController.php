<?php

namespace App\Http\Controllers;

use \PDF;
use App\Models\User;
use App\Models\Student;
use App\Rules\AlphaSpaces;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ClassAttendance;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => ['required', 'max:30', 'min:2', new AlphaSpaces],
            'LastName' => ['required', 'max:30', 'min:2', new AlphaSpaces],
            'MiddleInitial' => 'min:0|max:1',
            'Course' => 'required',
            // 'g-recaptcha-response' => 'required|captcha',
            'StudentNumber' => 'required|max:30|min:2|unique:users,student_no',
        ],
        //  [
        //     'g-recaptcha-response.required' => 'Captcha is required',
        //     'g-recaptcha-response.captcha' => 'Captcha is invalid',
        // ]
        );

        $studentNumber = $request->input('StudentNumber');
        $data = User::where('student_no', $studentNumber)->first();
        if($data){
            $token = $data->token;
            return redirect('/student/'.$token.'/qrcode');
    }

        $token = Str::random(20);

        $user = ([
            'firstname' => $request->FirstName,
            'lastname' => $request->LastName,
            'middleinitial' => $request->MiddleInitial,
            'email' => null,
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
        ClassAttendance::where('student_token', $user->student_no)->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Student Deleted');
    }

    public function show($token)
    {
        $data = User::where('token', $token)->first();
        return view('students.qr', compact('data'));
    }

    public function download($token)
    {
        $data = User::where('token', $token)->first();
        $pdf = PDF::loadView('print.qr_print', compact('data'));

        $customPaper = array(0,0,360, 504);

        $pdf->setPaper($customPaper);
        $pdf->render();
        return $pdf->stream('qr_code.pdf');
    }

}
