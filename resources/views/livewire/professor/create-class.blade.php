<div>
    <h1>Create Class</h1>
    <form wire:submit.prevent="createClass" method="POST">
        <x-form-group label="Subject Name" id="ClassName" type="text" value="class_name"/>
        <x-form-group label="Room number" id="ClassRoom" type="text" value="class_room"/>
        <label class="dropdown-label" for="ClassSection">Section</label>
        <select name="ClassSection" id="ClassSection" wire:model="class_section" style="margin-bottom: 20px">
            @foreach($dropdown as $key => $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        </select>
        @error('class_section')
            <p class="error">{{ $message }}</p>
        @enderror
        <div class="radio-container">
            <label class="dropdown-label" >Day</label>
            <div class="radio-group">
                <input type="checkbox" wire:model="monday" name="track" value="Monday" id="Monday" />
                <label for="Monday">Monday</label>
                <input type="checkbox" wire:model="tuesday" name="track" value="Tuesday" id="Tuesday" />
                <label for="Tuesday">Tuesday</label>
                <input type="checkbox" wire:model="wednesday" name="track" value="Wednesday" id="Wednesday" />
                <label for="Wednesday">Wednesday</label>
                <input type="checkbox" wire:model="thursday" name="track" value="Thursday" id="Thursday" />
                <label for="Thursday">Thursday</label>
                <input type="checkbox" wire:model="friday" name="track" value="Friday" id="Friday" />
                <label for="Friday">Friday</label>  
            </div>
            @error('days') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="row">
            <x-form-group label="Start Time" id="StartTime" type="time" value="class_start"/>
            <x-form-group label="End Time" id="EndTime" type="time" value="class_end"/>
        </div>
        
        
        <input id="submit" type="submit" value="Create Class" wire:loading.attr="disabled">
    </form>
</div>
