<div>
    <h1>Add student</h1>
    <form wire:submit.prevent="create" method="POST">
        <x-form-group label="Student Number" id="StudentNumber" type="text" value="student_no"/>
        <x-form-group label="First Name" id="FirstName" type="text" value="firstname"/>
        <div class="row">
            <x-form-group label="Last Name" id="LastName" type="text" value="lastname"/>
            <x-form-group label="Middle Initial" id="MiddleInitial" type="text" value="middleinitial"/>
        </div>
        <label class="dropdown-label" for="Course">Year & Section</label>
        <select wire:model="section" name="Course" id="Course">
            @foreach($tracks as $track)
                <option value="{{ $track }}">{{ $track }}</option>
            @endforeach
        </select>
        @error('section')
            <p class="error">{{ $message }}</p>
        @enderror
        <input id="submit" type="submit" value="Create Account" wire:loading.attr="disabled">
    </form>
</div>