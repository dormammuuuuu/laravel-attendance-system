<div>
    <x-loading-screen/>
    <form class="right" wire:submit.prevent="save">
        <div>
            <h1>Upload document</h1>
            <p>Please upload your University ID to continue using our platform.</p>
        </div>
        <div class="wrapper" >
            <div class="file-upload" >
                <input type="file" wire:model="photo" accept="image/*"/>
                <i class='bx bx-arrow-from-bottom'></i>
            </div>
            @if ($photo)
                <p class="filename">File: {{ $photo->getClientOriginalName() }}</p>
            @endif
        </div>
        @error('photo') <span class="error">{{ $message }}</span> @enderror
        <div class="row">
            <a href="{{ route('auth.logout') }}">Logout</a>
            <input type="submit" id="submit" value="Upload">
        </div>
    </form>
</div>
