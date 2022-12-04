<div>
    <form action="{{ route('register.professor') }}" method="POST">
        @csrf
        <x-form-group label="First Name" id="FirstName" type="text" value="firstname"/>
        <div class="row">
            <x-form-group label="Last Name" id="LastName" type="text" value="lastname"/>
            <x-form-group label="Middle Initial" id="MiddleInitial" type="text" value="middleinitial"/>
        </div>
        <x-form-group label="Email" id="Email" type="email" value="email"/>
        <x-form-group label="Username" id="UserName" type="text" value="username"/>
        <div class="row">
            <x-form-group label="Password" id="password" type="password" value="Password"/>
            <x-form-group label="Confirm Password" id="password_confirmation" type="password" value="Password_confirmation"/>
        </div>
        <input id="submit" type="submit" value="Register">
    </form>
</div>
