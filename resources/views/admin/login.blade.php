@extends('./layouts.main')

@section('title', 'ADMIN | Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endsection

@section('js')
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
    </div>
    <x-footer.index-footer/>
@endsection