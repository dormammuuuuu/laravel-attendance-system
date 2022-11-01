<div>
    <h1>Export Attendance</h1>
    <div class="tools">
        <button wire:click="exportToday">Export Today's Attendance</button>
        <button wire:click="exportWeekly">Export this weeks attendance</button>
        <a href="/professor/class/{{$classToken}}/calendar/{{$classDate}}/export">Export All Attendance (EXCEL)</a>
    </div>
</div>
