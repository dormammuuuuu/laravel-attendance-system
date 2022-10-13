@extends('./layouts.main')

@section('title', 'Professor Registration')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('js')
@endsection    

@section('content')
    <div id="form-container">
        <div class="form-header">
            <h2>Professor Registration</h2>
        </div>
        <form action="{{ route('register.professor') }}" method="POST">
            @csrf
            <x-form-group label="First Name" id="FirstName" type="text" />
            <div class="row">
                <x-form-group label="Last Name" id="LastName" type="text" />
                <x-form-group label="Middle Initial" id="MiddleInitial" type="text" />
            </div>
            <x-form-group label="Username" id="UserName" type="text" />
            <x-form-group label="Password" id="password" type="password" />
            <x-form-group label="Confirm Password" id="password_confirmation" type="password" />
            <input id="submit" type="submit" value="Register">
        </form>
        <div class="form-footer">
            <p>Already have an account? <a href="{{ route('professors.login') }}">Log in</a></p>
        </div>
    </div>
@endsection