<div>
    <h1>Edit User</h1>
    <form wire:submit.prevent="update" method="POST">
        <x-form-group label="First Name" id="FirstName" type="text" value="firstname" />
        <div class="row">
            <x-form-group label="Last Name" id="LastName" type="text" value="lastname"/>
            <x-form-group label="Middle Initial" id="MiddleInitial" type="text" value="middleinitial"/>
        </div>
        <x-form-group label="Email" id="Email" type="email" value="email" />
        <x-form-group label="Username" id="UserName" type="text" value="username"/>
        <input id="submit" type="submit" value="Save User Data" wire:loading.attr="disabled">
    </form>
</div>
