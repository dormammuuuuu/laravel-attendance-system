@extends('./layouts.main')

@section('title', 'Professor Registration')

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
                <a href="{{ route('students.index') }}" class="button button--ghost">Student</a>
            </ul>
        </x-slot>
    </x-navbar.index-navbar>
    <div class="wrapper">
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
                <x-form-group label="Email" id="Email" type="text" />
                <x-form-group label="Username" id="UserName" type="text" />
                <div class="row">
                    <x-form-group label="Password" id="password" type="password" />
                    <x-form-group label="Confirm Password" id="password_confirmation" type="password" />
                </div>
                <input id="submit" type="submit" value="Register">
            </form>
            <div class="form-footer">
                <p>Already have an account? <a href="{{ route('professors.login') }}">Log in</a></p>
            </div>
        </div>
    </div>
    <x-footer.index-footer/>
@endsection