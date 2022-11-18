@extends('./layouts.main')

@section('title', 'ASHMR')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')
    <x-navbar.index-navbar>
        <x-slot name="links">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="#" class="nav__link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="#about" class="nav__link">About</a>
                </li>
                @auth
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="button button--ghost">Dashboard</a>
                    @else
                        <a href="{{ route('professors.dashboard') }}" class="button button--ghost">Dashboard</a>
                    @endif
                @else
                    <li class="nav__item">
                        <a href="{{ route('professors.login') }}" class="nav__link">Professor</a>
                    </li>
                    <a href="{{ route('students.index') }}" class="button button--ghost">Student</a>
                @endauth
            </ul>
        </x-slot>
    </x-navbar.index-navbar>
    <main class="main">
        <!-- HOME -->
        <section class="home container" id="home">
            <div class="swiper home-swiper">
                <div class="swiper-wrapper">
                    <!-- HOME SLIDER 1 -->
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img
                                    src="{{ asset('img/banner2.png') }}"
                                    alt="" class="home__img">
                            </div>
                            <div class="home__data">
                                <h3 class="home__subtitle">QR Attendance</h3>
                                <h1 class="home__title">Scan <br>Monitor <br>Export </h1>
                                <p class="home__description">Attendance monitoring has been easier thanks to the QR Code Scanning technique.</p>
                                <div class="home__buttons">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <!-- ABOUT -->
        <section class="section about" id="about">
            <div class="about__container container grid">
                <div class="about__data">
                    <h2 class="section__title about__title">About ASHMR</h2>
                    <p class="about__description">ASHMR is a new Attendance Monitoring System that tracks all SHS students at Our Lady of Lourdes College. To make it faster and easier for every professor and student to get their attendance by simply scanning their QR code with a unique and helpful platform support service.</p>
                </div>
                <img src="{{asset('img/about.png')}}" alt=""
                class="about__img">
            </div>
        </section>
        <!-- SCROLL UP -->
        
        <a href="#" class="scrollup" id="scroll-up">
            <i class='bx bx-up-arrow-alt scrollup__icon'></i>
        </a>

        <x-footer.index-footer/>
    </main>
@endsection