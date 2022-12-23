<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Redirect,Response;
use App\Models\Classroom;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use App\Models\ClassAttendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;


class AdminController extends Controller
{
    
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        $student = User::where('role', 'student')->count('id');
        $prof = User::where([
            ['role', 'professor'],
            ['approved', 1]
        ])->count('id');
        $class = Classroom::count('id');
        return view('admin.dashboard', compact('student', 'prof', 'class'));
    }

    public function archived(){
        $data = User::onlyTrashed()->paginate(10);
        return view('admin.archived')->with('data', $data);
    }

    public function archivedProfile($token){
        $user = User::withTrashed()->where('token', $token)->first();
        return view('admin.archived-profile', compact('user', 'token'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'UserName' => 'required',
            'password' => 'required'
        ]);     

        $data = ([
            'username' => $request->UserName,
            'password' => $request->password,
            'role' => 'admin'
        ]);


        if (auth()->attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'UserName' => 'The provided credentials do not match our records.',
        ]);
    }

    public function registrations()
    {
        $data = User::where([
            'role' => 'professor',
            'approved' => false
        ])->paginate(10);
        return view('admin.registrations')->with('data', $data);
    }

    public function professors()
    {
        $data = User::where([
            'role' => 'professor',
            'approved' => true
        ])->paginate(10);
        return view('admin.professors')->with('data', $data);
    }

    public function students()
    {
        $data = User::where('role', 'student')->paginate(10);
        return view('admin.students')->with('data', $data);
    }

    public function admins(){
        $data = User::where('role', 'admin')->paginate(10);
        return view('admin.admins')->with('data', $data);
    }

    public function edit(Request $request){
        $user = User::where('token', $request->token)->first();
        return response()->json(['data'=>$user]);
    }

    public function classes(){
        $data = Classroom::paginate(10);
        return view('admin.classes');
    }

    public function classView($token){
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
        return view('admin.class-view', compact('subject', 'students', 'session', 'attendance'));
    }

    public function profile($token){
        $user = User::where('token', $token)->first();
        return view('admin.professors-profile', compact('user', 'token'));
    }

    public function settings(){
        return view('admin.settings');
    }
    
    public function maintenance(Request $request)
    {
        $hashedPassword = Auth::user()->password;
        $providedPassword = $request->input('Password');
        
        if (Hash::check($providedPassword, $hashedPassword)) {
            if (app()->isDownForMaintenance()){
                Artisan::call('up');
                return redirect()->route('admin.settings')->with('success', 'Maintenance mode is now turned off.');
            } else {
                Artisan::call('down', [
                    '--secret' => 'adminonly',
                ]);
                $url = '/' . 'adminonly';
                return redirect($url)->with('success', 'Maintenance mode is now on.');
            }
        } else {
            return back()->withErrors([
                'Password' => 'The password you entered is incorrect.',
            ]);
        }
    }
}
