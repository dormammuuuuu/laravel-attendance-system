@extends('./layouts.main')

@section('title', 'Professor | Account Settings')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection    

@php
    $firstname = auth()->user()->firstname;
    $lastname = auth()->user()->lastname;
    $middleinitial = auth()->user()->middleinitial;     
@endphp

@section('content')
    <x-sidebar.sidebar firstname="{{$firstname}}" lastname="{{$lastname}}" middleinitial="{{$middleinitial}}">
        <x-sidebar.professor-sidebar/>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="Account Settings" />

        <x-acct-settings-form :action="route('professors.profile.update')" title="Profile" details="This is the information about your profile that will be displayed on the platform.">
            <x-slot name="form">
                <x-form-group-acct-profile label="First Name" id="FirstName" type="text" value="{{$user->firstname}}"/>
                <div class="row">
                    <x-form-group-acct-profile label="Last Name" id="LastName" type="text" value="{{$user->lastname}}"/>
                    <x-form-group-acct-profile label="Middle Initial" id="MiddleInitial" type="text" value="{{$user->middleinitial}}"/>
                </div>
                <input type="submit" name="profile" class="submit-settings" value="Apply Changes">
            </x-slot>
        </x-acct-settings-form>

        <x-acct-settings-form :action="route('professors.credentials.update')" title="Credentials" details="Modify your email and username ">
            <x-slot name="form">
                <x-form-group-acct-profile label="Email" id="Email" type="email" value="{{$user->email}}"/>
                <x-form-group-acct-profile label="Username" id="UserName" type="text" value="{{$user->username}}"/>
                <input type="submit" name="profile" class="submit-settings" value="Apply Changes">
            </x-slot>
        </x-acct-settings-form>

        <x-acct-settings-form :action="route('professors.password.update')" title="Password" details="Change your account password">
            <x-slot name="form">
                <x-form-group-acct-profile label="Current Password" id="CurrentPassword" type="password" value=""/>
                <x-form-group-acct-profile label="New Password" id="password" type="password" value=""/>
                <x-form-group-acct-profile label="Confirm Password" id="password_confirmation" type="password" value=""/>
                <input type="submit" name="profile" class="submit-settings" value="Apply Changes">
            </x-slot>
        </x-acct-settings-form>

    </div>
    {{-- here --}}
@endsection