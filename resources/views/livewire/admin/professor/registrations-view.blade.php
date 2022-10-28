<div class="verification-container">
    <div class="id-container">
        @if($photo)
            <img src="{{ $photo }}" alt="ID" class="id-view">
        @else
            <p>No document uploaded</p>
        @endif
    </div>
    <div>
        <p class="name">{{ $fullname }}</p>
        <p class="username">{{ '@'.$username }}</p>
        <p class="email">{{ $email }}</p>
        <div class="button-container">
            <button wire:click="reject" class="reject">Reject</button>
            <button wire:click="approve" class="approve">Approve</button>
        </div>
    </div>
</div>
