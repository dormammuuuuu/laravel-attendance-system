<div>
    <form action="{{ route('register.student') }}" method="POST">
        @csrf
        <x-form-group label="Student Number" id="StudentNumber" type="text" value="student_no"/>
        <x-form-group label="First Name" id="FirstName" type="text" value="firstname"/>
        <div class="row">
            <x-form-group label="Last Name" id="LastName" type="text" value="lastname"/>
            <x-form-group label="Middle Initial" id="MiddleInitial" type="text" value="middleinitial"/>
        </div>
        <label class="dropdown-label" for="Course">Section</label>
        <select name="Course" id="Course" wire:model="course">
            @foreach($tracks as $track)
                <option value="{{ $track }}">{{ $track }}</option>
            @endforeach
        </select>
        @error('Course')
            <p class="error">{{ $message }}</p>
        @enderror
        {{-- {!! NoCaptcha::renderJs() !!}
        <div class="captcha">
            {!! NoCaptcha::display() !!}
        </div>
        @error('g-recaptcha-response')
            <p class="error">{{ $message }}</p>
        @enderror --}}
        <input id="submit" type="submit" value="Register">
    </form>
</div>
