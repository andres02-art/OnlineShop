
<div class="container">
    {{ $slot }}
    <a class="navbar-brand" href="{{ url('/') }}">
        mercado libre
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else

                <!--Option-menu-->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#profileSideBar" aria-controls="offcanvasScrolling">Opciones</a>
                </li>

                <x-options></x-options>

            @endguest
        </ul>
    </div>
</div>
