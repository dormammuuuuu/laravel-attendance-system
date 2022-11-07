@extends('./layouts.main')

@section('title', 'Student Registration')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>
@endsection    

@section('content')
    <x-navbar.index-navbar>
        <x-slot name="links">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{ route('index') }}" class="nav__link">Home</a>
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
                <h2>Student Registration</h2>
            </div>
            @livewire('student-registration-form')
        </div>
    </div>
    <script>
        // var element = document.getElementById('StudentNumber');
        // var maskOptions = {
        //    mask: '(000)000-00-00'
        // };
        // var mask = IMask(element, maskOptions);
    </script>
    <x-footer.index-footer/>
@endsection