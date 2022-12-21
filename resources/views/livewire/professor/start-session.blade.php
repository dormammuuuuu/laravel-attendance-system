<div>
    <h1>Meeting Settings</h1>
    <form wire:submit.prevent="startSession">
        <label for="endTime">Number of Hours</label>
        <select class="select-hour" wire:model="endTime">
            <option value="1">1 hr</option>
            <option value="2">2 hrs</option>
            <option value="3">3 hrs</option>
        </select>
    
        <label for="seekbar" class="label-seek">Late after: {{$minutesSeekbar}} minutes</label>
        <input type="range" wire:model="minutesSeekbar" min="5" max="20" value="5">
        <div class="start-session">
            <button type="submit" href="/professor/class/{{$token}}/start">Start Session</button>
        </div>
    </form>
</div>
