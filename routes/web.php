<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('students.index');
});

Route::get('/login', function(){
    return redirect()->route('students.index');
})->name('login');


//Student Routes
Route::get('/student/signup', 'App\Http\Controllers\StudentController@index')->name('students.index')->middleware('guest');
Route::post('/register/student', 'App\Http\Controllers\StudentController@store')->name('register.student');
Route::get('/student/{token}/qrcode', 'App\Http\Controllers\StudentController@show');
Route::get('/student/{token}/qrcode/download', 'App\Http\Controllers\StudentController@download');



//Professor Routes
    //Professor Registration
Route::get('/professor/signup', 'App\Http\Controllers\ProfessorController@index')->name('professors.index')->middleware('guest');
Route::post('/register/professor', 'App\Http\Controllers\ProfessorController@store')->name('register.professor');
    //Professor Login
Route::get('/professor/login', 'App\Http\Controllers\ProfessorController@login')->name('professors.login')->middleware('guest');
Route::post('/authenticate/professor', 'App\Http\Controllers\ProfessorController@authenticate')->name('auth.professor');
    //Professor Dashboard
Route::get('/professor/dashboard', 'App\Http\Controllers\ProfessorController@dashboard')->name('professors.dashboard')->middleware('auth');
    //Professor Class Dashboard
Route::get('/professor/class/{token}', 'App\Http\Controllers\ProfessorController@classDashboard')->name('professors.class.dashboard')->middleware('auth');
    //Professor Manage Class
Route::get('/professor/class/{token}/manage', 'App\Http\Controllers\ProfessorController@manageClass')->name('professors.class.manage')->middleware('auth');
    //Professor Delete Class
Route::get('/professor/class/{token}/delete', 'App\Http\Controllers\ProfessorController@deleteClass')->name('professors.class.delete')->middleware('auth');
    //Professor Start Class
Route::get('/professor/class/{token}/start', 'App\Http\Controllers\ProfessorController@startClass')->name('professors.class.start')->middleware('auth');
    //Professor Attendance
Route::get('/professor/class/{token}/calendar', 'App\Http\Controllers\ProfessorController@calendar')->name('professors.class.calendar')->middleware('auth');
    //Professor Attendance
Route::get('/professor/class/{token}/calendar/{date}', 'App\Http\Controllers\ProfessorController@attendance')->name('professors.class.attendance')->middleware('auth');

//Admin Routes
    //Admin Login
Route::get('/admin/login', 'App\Http\Controllers\AdminController@login')->name('admin.login')->middleware('guest');
Route::post('/authenticate/admin', 'App\Http\Controllers\AdminController@authenticate')->name('auth.admin');
    //Admin Dashboard
Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard')->middleware('useraccess');
    //Admin Registration Management
Route::get('/admin/registrations', 'App\Http\Controllers\AdminController@registrations')->name('admin.registrations')->middleware('useraccess');
    //Admin Registration Approval
Route::get('/admin/registrations/{token}/approve', 'App\Http\Controllers\AdminController@approve')->name('admin.approve')->middleware('useraccess');
    //Admin Registration Disapproval
Route::get('/admin/registrations/{token}/reject', 'App\Http\Controllers\AdminController@disapprove')->name('admin.disapprove')->middleware('useraccess');
    //Admin Professor Management
Route::get('/admin/professors', 'App\Http\Controllers\AdminController@professors')->name('admin.professors')->middleware('useraccess');
    //Admin Student Management
Route::get('/admin/students', 'App\Http\Controllers\AdminController@students')->name('admin.students')->middleware('useraccess');
    //Admin Class Management
Route::get('/admin/classes', 'App\Http\Controllers\AdminController@classes')->name('admin.classes')->middleware('useraccess');
    //Admin Class View
Route::get('/admin/classes/{token}', 'App\Http\Controllers\AdminController@classView')->name('admin.class.view')->middleware('useraccess');
    //Admin Admin Management
Route::get('/admin/admins', 'App\Http\Controllers\AdminController@admins')->name('admin.admins')->middleware('useraccess');

    //Admin Delete Student
Route::get('/student/{token}/delete', 'App\Http\Controllers\StudentController@destroy')->name('student.delete');
    //Admin Delete Professor
Route::get('/professor/{token}/delete', 'App\Http\Controllers\ProfessorController@destroy')->name('professor.delete');
//Admin Get User
Route::post('/admin/user/get', 'App\Http\Controllers\AdminController@edit')->name('admin.edit');

//Logout Route
Route::get('/logout', function(){
    auth()->logout();
    return redirect('/');
})->name('auth.logout');