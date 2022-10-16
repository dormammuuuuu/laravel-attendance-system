<div>
    <div class="scanner-container">
        <video id="preview"></video>
        <form wire:submit.prevent="qrCode" method="POST">
            <div class="qr-form">
                <input class="field" placeholder="Student number" type="text" name="qr-live" id="qr-live" wire:model.defer="qrlive">
                <input class="submit" type="submit" value="Submit" id="submit-live">
                @error('qrlive')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            
        </form>    
    </div>
    {{-- 9781-84668-BL-3 --}}
    <div class="user-info {{$show}}">
        <p class="present">Status: Present</p>
        <p class="heading">User details</p> 
        <p>Student number: <span class="detail">{{$student_no}}</span></p>
        <p>Full name: <span class="detail">{{$lastname}}, {{$firstname}} {{$middleinitial}}</span></p>
    </div>
</div>

