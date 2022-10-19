<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Str;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use App\Models\ClassAttendance;

class ProfessorController extends Controller
{
    //
    public function index()
    {
        
        return view('professors.index');
    }

    public function login(){
        return view('professors.login');
    }

    public function dashboard(){
        return view('professors.dashboard');
    }

    public function authenticate(Request $request){
        $request->validate([
            'UserName' => 'required',
            'password' => 'required'
        ]);

        $user = ([
            'username' => $request->UserName,
            'password' => $request->password
        ]);
        


        $temp = User::where([
            'username'=> $request->UserName,
        ])->first();

        if($temp){
            if($temp->approved == 0){
                return back()->with('error', 'Your account is not yet approved by the admin.');
            }
        }

        if(auth()->attempt($user)){
            $request->session()->regenerate();
            return redirect()->route('professors.dashboard');
        }


        return redirect()->route('professors.login')->withErrors([
            'UserName' => 'The provided credentials do not match our records.'
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'FirstName' => 'required|max:30|min:2',
            'LastName' => 'required|max:30|min:2',
            'MiddleInitial' => 'required|max:1|min:1',
            'UserName' => 'required|max:30|min:2|unique:users,username',
            'password' => 'required|max:30|min:6|confirmed',
        ]);

        $user = ([
            'firstname' => $request->FirstName,
            'lastname' => $request->LastName,
            'middleinitial' => $request->MiddleInitial,
            'username' => $request->UserName,
            'password' => bcrypt($request->password),
            'role' => 'professor',
            'token' => Str::random(20),
            'approved' => 0,
        ]);

        User::create($user);

        return redirect()->route('professors.index')->with('success', 'Please wait for an admin to approve your account');
    }

    public function destroy($token){
        $user = User::where('token', $token)->first();
        $user->delete();
        return redirect()->back()->with('success', 'Professor Deleted');
    }

    public function classDashboard($token){
        $subject = Classroom::where('class_token', $token)->first();
        
        $student = User::where([
            'role' => 'student',
            'section' => $subject->class_section,
        ])->get();
        $students = $student->count();

        $class = ClassSession::where(['class_token' => $token])->get();
        $session = $class->count();

        $temp = ClassAttendance::where(['class_token' => $token, 'attendance_day' => Carbon::now()->format('Y-m-d')])->get();
        $attendance = $temp->count() / $students * 100;
        $attendance = round($attendance);
        return view('professors.class', compact('subject', 'students', 'session', 'attendance'));
    }

    public function manageClass($token){
        $subject = Classroom::where('class_token', $token)->first();
            
        return view('professors.manageclass', compact('subject', 'token'));
    }

    public function deleteClass($token){
        $class = Classroom::where('class_token', $token)->first();
        ClassAttendance::where('class_token', $token)->delete();
        ClassSession::where('class_token', $token)->delete();
        $class->delete();
        
        return redirect()->route('professors.dashboard')->with('success', 'Class Deleted');
    }

    public function startClass($token){
        $attempt = ClassSession::where([
            'class_token' => $token,
            'class_date' => Carbon::now()->format('Y-m-d'),
        ])->first();

        if (!$attempt) {
            ClassSession::create([
                'class_token' => $token,
                'class_date' => Carbon::now()->format('Y-m-d'),
            ]);
        }

        $subject = Classroom::where('class_token', $token)->first();
        $token = $subject->class_token;
        return view('professors.start-class', compact('subject', 'token'));
    }

    public function calendar($token){
        $subject = Classroom::where('class_token', $token)->first();
        return view('professors.class-calendar', compact('subject'));
    }

    public function attendance($token, $date){
        $data = ClassSession::where([
            'class_token' => $token,
            'class_date' => $date,
        ])->first();
        
        if ($data){
            $subject = Classroom::where('class_token', $token)->first();
            $section = $subject->class_section;

            $students = User::where([
                'role' => 'student',
                'section' => $section,
            ])->get();

            return view('professors.attendance', compact('students', 'subject', 'date'));
        }
        else {
            abort(404);
        }
    }
}
