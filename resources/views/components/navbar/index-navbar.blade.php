<div>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="{{ route('index') }}" class="nav__logo"> 
                <img src="{{asset('img/logo.png')}}" alt="Logo">    
                ASHMR 
            </a>
            <div class="nav__menu" id="nav-menu">
                    {{ $links }}
                <div class="nav__close" id="nav-close">
                    <i class='bx bx-x'></i>
                </div>
            </div>
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>
        </nav>
    </header>
</div>