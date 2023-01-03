<div>
    <h1>Meeting Settings</h1>
    <form wire:submit.prevent="startSession">   
        <label for="seekbar" class="label-seek">Late after: {{$minutesSeekbar}} minutes</label>
        <input type="range" wire:model="minutesSeekbar" min="5" max="20" value="5">
        <div class="start-session">
            <button type="submit" href="/professor/class/{{$token}}/start">Start Session</button>
        </div>
    </form>
</div>
