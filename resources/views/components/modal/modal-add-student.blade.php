<div class="modal-container">
    <div class="modal">
        <div class="header">
            <h2>{{ $title }}</h2>
            <button wire:click="closeEditModal()" class="close"><i class='bx bx-x bx-sm'></i></button>
        </div>
        <div class="body">
            {{ $body}}
        </div>
        <div class="footer">
            {{ $footer }}
        </div>
    </div>
</div>