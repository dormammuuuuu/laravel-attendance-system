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
        <x-sidebar.admin-sidebar/>
    </x-sidebar.sidebar>
    <div id="main">
        <x-navbar.navbar title="System Settings" />
        <p style="text-align: center; margin: 40px 0; color: red; font-weight: bold; font-size: 14px">Warning: Please be aware that any changes made here will affect the entire system.</p>
        <x-acct-settings-form :action="route('admin.maintenance')" title="Maintenance Mode" details="Except for administrators, this will disable all user access and operations. To continue using the platform, all administrators will get an email with an access link.">
            <x-slot name="form">
                <x-form-group-acct-profile label="Password" id="Password" type="password" value=""/>
                @if (app()->isDownForMaintenance())
                    <input type="submit" name="profile" class="submit-settings" value="Deactivate Maintenance Mode">
                @else
                    <input type="submit" name="profile" class="submit-settings" value="Activate Maintenance Mode">
                @endif
            </x-slot>
        </x-acct-settings-form>
        <x-acct-settings-form :action="route('admin.schoolyear')" title="System School Year" details="This setting will start the next school year. This will promote all students from their current year and archive all classes from the previous year. Upgrading to the next school year is irreversible.">
            <x-slot name="form">
                <p style="margin-bottom: 5px; font-size: 15px;"> Current system school year: <strong>{{$currentSchoolYear}}</strong></p>
                <p style="margin-bottom: 20px; font-size: 15px;"> Next school year: <strong>{{$nextSchoolYear}}</strong> </p>
                <x-form-group-acct-profile label="Activating the next school year requires your password. Please enter it and confirm that you wish to proceed." id="syPassword" type="password" value=""/>
                
                <input type="submit" name="profile" class="submit-settings" value="Activate Next School Year">
            </x-slot>
        </x-acct-settings-form>
    </div>
    {{-- here --}}
@endsection