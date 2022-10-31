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
                <div class="email-container">
                    <p>Reset password for:</p>
                    <p class="email">{{ $reset->email }}</p>
                </div>
            </div>
            <form action="{{route('account.update.reset.password', $reset->token)}}" method="POST" id="forgot-form">
                @csrf
                <x-form-group label="New password" id="password" type="password" />
                <x-form-group label="Confirm new password" id="password_confirmation" type="password" />
                <input id="submit" type="submit" class="margin" value="Update password">
            </form>
        </div>
    </div>
@endsection