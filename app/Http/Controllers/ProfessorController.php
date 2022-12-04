<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\Classroom;
use App\Rules\AlphaSpaces;
use Illuminate\Support\Str;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use App\Models\ClassAttendance;
use App\Exports\AttendanceExport;
use App\Mail\ResetPasswordMailer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ProfessorController extends Controller
{
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

        if(auth()->attempt($user)){
            $request->session()->regenerate();
            if (auth()->user()->approved == false) {
                return redirect()->route('professors.verification');
            }
            else{
                return redirect()->route('professors.dashboard');
            }
        }


        return redirect()->route('professors.login')->withErrors([
            'UserName' => 'The provided credentials do not match our records.'
        ]);
    }

    public function requirements(){
        if (auth()->user()->approved == true && auth()->user()->role == 'professor') {
            return redirect()->route('professors.dashboard');
        }
        return view('professors.requirements');
    }

    public function store(Request $request){
        // $request->merge([
        //     'email' => $request->email . '@gmail.com',
        // ]);
        $request->validate([
            'FirstName' => ['required', 'max:30', 'min:2', new AlphaSpaces],
            'LastName' => ['required', 'max:30', 'min:2', new AlphaSpaces],
            'MiddleInitial' => 'max:1|min:0',
            'Email' => 'required|email|unique:users,email',
            'UserName' => 'required|max:30|min:2|unique:users,username',
            'password' => 'required|max:30|min:6|confirmed',
        ]);

        $user = ([
            'firstname' => $request->FirstName,
            'lastname' => $request->LastName,
            'middleinitial' => $request->MiddleInitial,
            'email' => $request->Email,
            'username' => $request->UserName,
            'password' => bcrypt($request->password),
            'role' => 'professor',
            'token' => Str::random(20),
            'approved' => 0,
        ]);

        User::create($user);

        $credentials = ([
            'username' => $request->UserName,
            'password' => $request->password
        ]);

        if(auth()->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('professors.verification');
        }
    }

    public function destroy($token){
        $user = User::where('token', $token)->first();
        $user->delete();
        Classroom::where('class_prof', $token)->delete();
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

    public function export($token, $date){
        $class = Classroom::where('class_token', $token)->get()->toArray();
        $subject = $class[0]['class_name'];
        $section = $class[0]['class_section'];
        $students = User::where([
            'role' => 'student',
            'section' => $section,
        ])->orderBy('lastname', 'asc')->get();
        $dates = ClassSession::where('class_token', $token)->orderBy('class_date', 'asc')->get()->toArray();
        $firstDate = $dates[0]['class_date'];
        $lastDate = $dates[count($dates) - 1]['class_date'];

        $dates = CarbonPeriod::create($firstDate, $lastDate)->toArray();
        $dates = array_map(function($date){
            return $date->format('Y-m-d');
        }, $dates);
        return Excel::download(new AttendanceExport($students, $dates, $token, $section), $subject . ' ' . $section . ' Attendance.xlsx');
    }

    public function account(){
        $user = auth()->user();
        return view('professors.account', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|max:30|min:2|alpha',
            'LastName' => 'required|max:30|min:2|alpha',
            'MiddleInitial' => 'max:1|min:0',
        ]);        

        $user = User::where('id', auth()->user()->id)->first();
        $user->firstname = $request->FirstName;
        $user->lastname = $request->LastName;
        $user->middleinitial = $request->MiddleInitial;

        if($user->isDirty()){
            $user->save();
            return redirect()->back()->with('success', 'Profile Updated');
        }
        else {
            return redirect()->back()->with('warning', 'No Changes Made');
        }
    }

    public function updateCredentials(Request $request)
    {
        $request->validate([
            'Email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'UserName' => 'required|max:30|min:2|unique:users,username,' . auth()->user()->id,
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        $user->email = $request->Email;
        $user->username = $request->UserName;
        if($user->isDirty()){
            $user->save();
            return redirect()->back()->with('success', 'Profile Updated');
        }
        else {
            return redirect()->back()->with('warning', 'No Changes Made');
        }
    }

    public function updatePassword(Request $request){
        $request->validate([
            'CurrentPassword' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        
        if(Hash::check($request->CurrentPassword, auth()->user()->password)){
            $user = User::where('id', auth()->user()->id)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Password Updated');
        }
        else {
            return redirect()->back()->with('error', 'Current password doesn\'t match');
        }
    }

    public function resetPassword()
    {
        return view('professors.request-password-reset');
    }

    public function sendResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            $token = Str::random(60);
            DB::table('reset_password')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::to($request->email)->send(new ResetPasswordMailer($token));
            return redirect()->back()->with('success', 'Password reset link sent to your email');
        }
        else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function reset($token)
    {
        $reset = DB::table('reset_password')->where('token', $token)->first();
        if($reset){
            return view('professors.password-reset', compact('reset'));
        }
        else {
            return redirect()->route('account.password.reset')->with('error', 'Invalid password reset token');
        }
    }

    public function updateReset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $reset = DB::table('reset_password')->where('token', $request->token)->first();

        if($reset){
            $user = User::where('email', $reset->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            DB::table('reset_password')->where('email', $reset->email)->delete();
            return redirect()->route('login')->with('success', 'Password has been changed!');
        }
        else {
            return redirect()->route('account.password.reset')->with('error', 'Invalid password reset token');
        }
    }
}
