<div>
    <h1>Add Admin</h1>
    <form wire:submit.prevent="create" method="POST">
        <x-form-group label="First Name" id="FirstName" type="text" value="firstname"/>
        <div class="row">
            <x-form-group label="Last Name" id="LastName" type="text" value="lastname"/>
            <x-form-group label="Middle Initial" id="MiddleInitial" type="text" value="middleinitial"/>
        </div>
        <x-form-group label="Username" id="UserName" type="text" value="username" />
        <x-form-group label="Password" id="password" type="password" value="password"/>
        <x-form-group label="Confirm Password" id="password_confirmation" type="password" value="password_confirmation" />
        <input id="submit" type="submit" value="Create Account">
    </form>
</div>