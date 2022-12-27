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
        <p class="{{$status}}" style="max-width: 100%">Status: {{ ucfirst($status) }}</p>
        <p class="heading">User details</p> 
        <p>Student number: <span class="detail">{{$student_no}}</span></p>
        <p>Full name: <span class="detail">{{$lastname}}, {{$firstname}} {{$middleinitial}}</span></p>
    </div>
    <hr style="width: 392px; margin: 20px auto;">
    <div class="user-info show">
        <p>Excuse a student</p>
        <form wire:submit.prevent="excuse">
            <div class="qr-form">
                <input class="field" placeholder="Student number" type="text" name="qr-live" id="qr-live" wire:model.defer="qrlive">
                <input class="submit" type="submit" value="Submit" id="submit-live">
                @error('qrlive')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </form>    
    </div>
</div>

