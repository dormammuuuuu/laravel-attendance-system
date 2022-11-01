@extends('./layouts.main')

@section('title', 'Reset Password | Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/verify.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection    

@section('content')
    <x-navbar.index-navbar>
        <x-slot name="links">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{route('index')}}" class="nav__link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="/#about" class="nav__link">About</a>
                </li>
                <li class="nav__item">
                    <a href="{{ route('professors.login') }}" class="nav__link">Professor</a>
                </li>
            </ul>
        </x-slot>
    </x-navbar.index-navbar>
    <div class="wrapper">
        <div class="card-container">
            <div class="left">
                <img src="{{ asset('img/forgot-password.svg') }}" alt="">
            </div>
            <div class="forgot-container">
                <div class="head">
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
    </div>
    <x-footer.index-footer/>
@endsection