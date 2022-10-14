@extends('./layouts.main')

@section('title', 'Student Registration')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('js')
@endsection    

@section('content')
    <div id="form-container">
        <div class="form-header">
            <h2>Student Registration</h2>
        </div>
        <form action="{{ route('register.student') }}" method="POST">
            @csrf
            <x-form-group label="Student Number" id="StudentNumber" type="text" />
            <x-form-group label="First Name" id="FirstName" type="text" />
            <div class="row">
                <x-form-group label="Last Name" id="LastName" type="text" />
                <x-form-group label="Middle Initial" id="MiddleInitial" type="text" />
            </div>
            <x-form-group label="Year & Section" id="Course" type="text" />
            <input id="submit" type="submit" value="Register">
        </form>
    </div>
@endsection