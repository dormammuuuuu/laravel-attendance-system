<div>
    <h1>Add student</h1>
    <form wire:submit.prevent="create" method="POST">
        <x-form-group label="Student Number" id="StudentNumber" type="text" value="student_no"/>
        <x-form-group label="First Name" id="FirstName" type="text" value="firstname"/>
        <div class="row">
            <x-form-group label="Last Name" id="LastName" type="text" value="lastname"/>
            <x-form-group label="Middle Initial" id="MiddleInitial" type="text" value="middleinitial"/>
        </div>
        <x-form-group label="Year & Section" id="Course" type="text" value="section"/>
        <input id="submit" type="submit" value="Create Account">
    </form>
</div>