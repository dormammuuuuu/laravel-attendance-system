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
            <label class="dropdown-label" for="Course">Section</label>
            <select name="Course" id="Course">
                <option></option>
                @foreach($tracks as $track)
                    <option value="{{ $track }}">{{ $track }}</option>
                @endforeach
            </select>
            @error('Course')
                <p class="error">{{ $message }}</p>
            @enderror
            {!! NoCaptcha::renderJs() !!}
            <div class="captcha">
                {!! NoCaptcha::display() !!}
            </div>
            @error('g-recaptcha-response')
                <p class="error">{{ $message }}</p>
            @enderror
            <input id="submit" type="submit" value="Register">
        </form>
    </div>
@endsection