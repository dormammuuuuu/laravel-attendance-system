<div class="calendar-header">
    <button wire:click="goToPreviousMonth"><i class="bx bx-chevron-left"></i></button>
    <h2 class="">{{ $this->startsAt->format('M Y') }} </h2>
    <button wire:click="goToNextMonth"><i class="bx bx-chevron-right"></i></button>
</div>