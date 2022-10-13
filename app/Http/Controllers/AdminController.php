<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect,Response;


class AdminController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'UserName' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('UserName', 'password');        

        if (Auth::attempt(['username' => $request->UserName, 'password' => $request->password, 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
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
    
    public function approve($token)
    {
        $user = User::where('token', $token)->first();
        $user->approved = true;
        $user->save();
        return redirect()->back()->with('success', 'Registration approved successfully!');
    }

    public function disapprove($token)
    {
        $user = User::where('token', $token)->first();
        $user->delete();
        return redirect()->back()->with('success', 'Registration disapproved successfully!');
    }

    public function edit(Request $request){
        $user = User::where('token', $request->token)->first();
        return response()->json(['data'=>$user]);
    }
}
