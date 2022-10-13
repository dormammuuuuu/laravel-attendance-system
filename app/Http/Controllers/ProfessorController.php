<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
            'UserName' => $request->UserName,
            'password' => $request->password
        ]);

        if(auth()->attempt($user)){
            $request->session()->regenerate();
            return redirect()->route('professors.dashboard');
        }

        return back()->withErrors([
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
            'password' => $request->password,
            'role' => 'professor',
            'token' => Str::random(20),
            'approved' => 0,
        ]);

        User::create($user);

        return redirect()->route('professors.index');
    }

    public function destroy($token){
        $user = User::where('token', $token)->first();
        $user->delete();
        return redirect()->back()->with('success', 'Professor Deleted');
    }

    public function classDashboard($token){
        $subject = Classroom::where('class_token', $token)->first();

        return view('professors.class', compact('subject'));
    }

    public function manageClass($token){
        $subject = Classroom::where('class_token', $token)->first();

        return view('professors.manageclass', compact('subject'));
    }

    public function deleteClass($token){
        $class = Classroom::where('class_token', $token)->first();
        $class->delete();
        return redirect()->route('professors.dashboard')->with('success', 'Class Deleted');
    }
}
