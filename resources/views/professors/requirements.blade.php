@extends('./layouts.main')

@section('title', 'Verify | Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/verify.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/verify.js') }}"></script>
@endsection    

@php
    $firstname = auth()->user()->firstname;
    $lastname = auth()->user()->lastname;
    $middleinitial = auth()->user()->middleinitial;     
    $user = \App\Models\VerificationId::where('user_token', auth()->user()->token)->first();
@endphp

@section('content')
    <div class="card-container">
        <div class="left">
            <img src="{{ asset('img/kyc.svg') }}" alt="">
        </div>
        @if(!$user)
            @livewire('id-verification');
        @else
            <div class="waiting">
                <div>
                    <p class="title">ID Submitted</p>
                    <p class="description">Please wait for the admin approval. An email will be sent to you once your account has been verified.</p>    
                </div>
                <a href="{{ route('auth.logout') }}">Logout</a>
            </div>           
        @endif
    </div>
@endsection