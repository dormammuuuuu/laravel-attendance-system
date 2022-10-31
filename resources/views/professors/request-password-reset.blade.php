@extends('./layouts.main')

@section('title', 'Reset Password | Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/verify.js') }}"></script>
@endsection    

@section('content')
    <div class="card-container">
        <div class="left">
            <img src="{{ asset('img/forgot-password.svg') }}" alt="">
        </div>
        <div class="forgot-container">
            <div class="header">
                <p class="title">Forgot Password</p>
                <p>Enter the email address associated with your account</p>
            </div>
            <form action="{{ route('account.password.reset.send') }}" method="POST" id="forgot-form">
                @csrf
                <x-form-group label="Email" id="email" type="email" />
                <input id="submit" type="submit" class="margin" value="Send">
            </form>
        </div>
    </div>
@endsection