<div>
    <h1>Create Class</h1>
    <form wire:submit.prevent="createClass" method="POST">
        <x-form-group label="Subject Name" id="ClassName" type="text" value="class_name"/>
        <x-form-group label="Room number" id="ClassRoom" type="text" value="class_room"/>
        {{-- <x-form-group label="Section" id="ClassSection" type="text" value="class_section"/> --}}
        <label class="dropdown-label" for="ClassSection">Section</label>
        <select name="ClassSection" id="ClassSection" wire:model="class_section">
            @foreach($dropdown as $key => $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>
        @error('class_section')
            <p class="error">{{ $message }}</p>
        @enderror
        <input id="submit" type="submit" value="Create Class">
    </form>
</div>
