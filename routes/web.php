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

//Professor Ungrouped Routes
    //Professor Registration
Route::get('/professor/signup', 'App\Http\Controllers\ProfessorController@index')->name('professors.index')->middleware('guest');
Route::post('/register/professor', 'App\Http\Controllers\ProfessorController@store')->name('register.professor');
    //Professor Login
Route::get('/professor/login', 'App\Http\Controllers\ProfessorController@login')->name('professors.login')->middleware('guest');
Route::post('/authenticate/professor', 'App\Http\Controllers\ProfessorController@authenticate')->name('auth.professor');

//Student Routes
Route::get('/student/signup', 'App\Http\Controllers\StudentController@index')->name('students.index')->middleware('guest');
Route::post('/register/student', 'App\Http\Controllers\StudentController@store')->name('register.student');
Route::get('/student/{token}/qrcode', 'App\Http\Controllers\StudentController@show');
Route::get('/student/{token}/qrcode/download', 'App\Http\Controllers\StudentController@download');
Route::get('/professor/verify', 'App\Http\Controllers\ProfessorController@requirements')->name('professors.verification')->middleware('auth');    


//Professor Groups
Route::prefix('professor')->middleware('auth', 'verified')->group(function () {
        //Professor Dashboard
    Route::get('/dashboard', 'App\Http\Controllers\ProfessorController@dashboard')->name('professors.dashboard');
        //Professor Class Dashboard
    Route::get('/class/{token}', 'App\Http\Controllers\ProfessorController@classDashboard')->name('professors.class.dashboard');
        //Professor Manage Class
    Route::get('/class/{token}/manage', 'App\Http\Controllers\ProfessorController@manageClass')->name('professors.class.manage');
        //Professor Delete Class
    Route::get('/class/{token}/delete', 'App\Http\Controllers\ProfessorController@deleteClass')->name('professors.class.delete');
        //Professor Start Class
    Route::get('/class/{token}/start', 'App\Http\Controllers\ProfessorController@startClass')->name('professors.class.start');
        //Professor Attendance
    Route::get('/class/{token}/calendar', 'App\Http\Controllers\ProfessorController@calendar')->name('professors.class.calendar');
        //Professor Attendance
    Route::get('/class/{token}/calendar/{date}', 'App\Http\Controllers\ProfessorController@attendance')->name('professors.class.attendance');
        //Professor Export
    Route::get('/class/{token}/calendar/{date}/export', 'App\Http\Controllers\ProfessorController@export')->name('professors.class.export');  
});

Route::prefix('admin')->middleware('useraccess')->group(function () {
        //Admin Dashboard
    Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');
        //Admin Registration Management
    Route::get('/registrations', 'App\Http\Controllers\AdminController@registrations')->name('admin.registrations');
        //Admin Registration Approval
    Route::get('/registrations/{token}/approve', 'App\Http\Controllers\AdminController@approve')->name('admin.approve');
        //Admin Registration Disapproval
    Route::get('/registrations/{token}/reject', 'App\Http\Controllers\AdminController@disapprove')->name('admin.disapprove');
        //Admin Professor Management
    Route::get('/professors', 'App\Http\Controllers\AdminController@professors')->name('admin.professors');
        //Admin Student Management
    Route::get('/students', 'App\Http\Controllers\AdminController@students')->name('admin.students');
        //Admin Class Management
    Route::get('/classes', 'App\Http\Controllers\AdminController@classes')->name('admin.classes');
        //Admin Class View
    Route::get('/classes/{token}', 'App\Http\Controllers\AdminController@classView')->name('admin.class.view');
        //Admin Admin Management
    Route::get('/admins', 'App\Http\Controllers\AdminController@admins')->name('admin.admins');
        //Professor View Profile
    Route::get('/professors/{token}/view', 'App\Http\Controllers\AdminController@profile')->name('admin.professors.profile');
});


//Admin Routes
    //Admin Login
Route::get('/admin/login', 'App\Http\Controllers\AdminController@login')->name('admin.login')->middleware('guest');
Route::post('/authenticate/admin', 'App\Http\Controllers\AdminController@authenticate')->name('auth.admin');
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