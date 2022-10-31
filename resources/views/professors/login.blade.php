@extends('./layouts.main')

@section('title', 'Professor | Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('js')
@endsection    

@section('content')
    <div id="form-container">
        <div class="form-header">
            <h2>Professor Login</h2>
        </div>
        <form action="{{ route('auth.professor') }}" method="POST">
            @csrf
            <x-form-group label="Username" id="UserName" type="text" value=""/>
            <x-form-group label="Password" id="password" type="password" value=""/>
            <input id="submit" type="submit" value="Log in">
        </form>
    <div class="form-footer">
            <p><a href="{{ route('account.password.reset') }}">Forgot Password</a></p>
            <p>Don't have an account? <a href="{{ route('professors.index') }}">Register</a></p>
        </div>
    </div>
@endsection