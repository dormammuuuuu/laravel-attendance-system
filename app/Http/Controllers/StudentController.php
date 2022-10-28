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
        $tracks = ['ICT 11-A', 'ICT 11-B', 'ICT 12-A', 'ICT 12-B', 'GAS 11-A', 'GAS 11-B', 'GAS 12-A', 'GAS 12-B', 'HUMSS 11-A', 'HUMSS 11-B', 'HUMSS 12-A', 'HUMSS 12-B', 'STEM 11-A', 'STEM 11-B', 'STEM 12-A', 'STEM 12-B', 'ABM 11-A', 'ABM 11-B', 'ABM 12-A', 'ABM 12-B', 'SPORT 11-A', 'SPORT 11-B', 'SPORT 12-A', 'SPORT 12-B'];
        return view('students.index', compact('tracks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|max:30|min:2|alpha',
            'LastName' => 'required|max:30|min:2|alpha',
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
        $pdf = PDF::loadView('print.qr_print', compact('data'));

        $customPaper = array(0,0,360, 504);

        $pdf->setPaper($customPaper);
        $pdf->render();
        return $pdf->stream('qr_code.pdf');
    }

}
