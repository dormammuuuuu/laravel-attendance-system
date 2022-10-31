@extends('./layouts.main')

@section('title', 'ADMIN | Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

@endsection

@section('js')
@endsection    

@section('content')
    <div id="form-container">
        <div class="form-header">
            <h2>Admin Login</h2>
        </div>
        <form action="{{ route('auth.admin') }}" method="POST">
            @csrf
            <x-form-group label="Username" id="UserName" type="text" />
            <x-form-group label="Password" id="password" type="password" />
            <input id="submit" type="submit" value="Login">
        </form>
        <div class="form-footer">
            <p><a href="{{ route('account.password.reset') }}">Forgot Password</a></p>
        </div>
    </div>
@endsection