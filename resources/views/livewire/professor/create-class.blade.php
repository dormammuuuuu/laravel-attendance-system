<div>
    <h1>Create Class</h1>
    <form wire:submit.prevent="createClass" method="POST">
        <x-form-group label="Subject Name" id="ClassName" type="text" value="class_name"/>
        <x-form-group label="Room number" id="ClassRoom" type="text" value="class_room"/>
        <x-form-group label="Section" id="ClassSection" type="text" value="class_section"/>
        <input id="submit" type="submit" value="Create Class">
    </form>
</div>
