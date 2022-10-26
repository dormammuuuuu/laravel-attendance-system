
<div class="calendar-header">
    <button wire:click="goToPreviousMonth"><i class="bx bx-chevron-left"></i></button>
    <h2 class="">{{ $this->startsAt->format('F Y') }} </h2>
    <button wire:click="goToNextMonth"><i class="bx bx-chevron-right"></i></button>
</div>
<p class="calendar-direction">To view the attendance, click through the dates with classes.</p>