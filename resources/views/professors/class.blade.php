@extends('./layouts.main')

@section('title')
    {{ $subject->class_name }} | {{ $subject->class_section }}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/classCard.css') }}">
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
        <x-navbar.navbar title="{{$subject->class_name}} | {{ $subject->class_section }}" />
        <div class="prof-class">
            {{ Breadcrumbs::render('professor-class', $subject) }}
            <div class="subject-card-container">
                <x-subject.dashboard-card label="Students" count="{{$students}}" icon="bx bx-user" style="red"/>
                <x-subject.dashboard-card label="Days" count="{{$session}}" icon="bx bx-sun"/>
                <x-subject.dashboard-card label="Attendance Today" count="{{$attendance}}%" icon="bx bx-calendar"/>
            </div>
            <div class="button-container">
                @if ($subject->class_school_year == $school_year)
                    @if (in_array(\Carbon\Carbon::now()->format('l'), array_map('trim', explode(',', $subject->class_days))))
                        @if (auth()->user()->token == $subject->class_prof)
                                @if ($sessionToday)
                                    @if(\Carbon\Carbon::parse($subject->class_end_time)->greaterThan(\Carbon\Carbon::now()->format('H:i:s')))
                                        <x-action-card target="" label="Join Current Session" desc="The session will end at {{ \Carbon\Carbon::createFromFormat('H:i:s', $subject->class_end_time)->format('g:i A') }}" link="/professor/class/{{$subject->class_token}}/start"/>
                                    @else
                                        <x-action-card target="" label="Session over" desc="The session for today is now finished." link="#"/> 
                                    @endif
                                @else
                                    @if (\Carbon\Carbon::parse($subject->class_start_time)->greaterThan(\Carbon\Carbon::now()->format('H:i:s')))
                                        <x-action-card target="" label="Session will be available later" desc="Your session will start at {{ \Carbon\Carbon::parse($subject->class_start_time)->format('h:i A')}}" link="#"/>
                                    @elseif (\Carbon\Carbon::parse($subject->class_end_time)->lessThan(\Carbon\Carbon::now()->format('H:i:s')))
                                        <x-action-card target="" label="Session missed" desc="You missed your session for today" link="#"/>

                                    @else
                                        <x-start-session-button label="Start Class" desc="Start your session now." token="{{$token}}"/>
                                    @endif    
                                @endif
                        @endif
                    @else 
                        <x-action-card target="" label="No class today" desc="You have no class today." link="#"/>
                    @endif
                @endif
                <x-action-card target="" label="Master list" desc="View the student list and export data, including the attendance for the entire semester." link="/professor/class/{{$subject->class_token}}/manage"/>
                <x-action-card target="" label="Calendar" desc="View student attendance at the calendar" link="/professor/class/{{$subject->class_token}}/calendar"/>
                
                @if (auth()->user()->token == $subject->class_prof || auth()->user()->role == 'admin')
                    <x-action-card target="" label="Delete" desc="This option will delete your class and all of its records. Delete at your own risk." link="/professor/class/{{$subject->class_token}}/delete"/>
                @endif
            </div>
        </div>
    </div>
@endsection