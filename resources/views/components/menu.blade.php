
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

        <form class="d-flex flex-row gap-2" id="search-form" action="{{ route('search') }}" method="get">
            @csrf
            <input class="form-control" type="text" placeholder="search" name="search">
            <button class="btn" type="submit">buscar</button>
        </form>

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
                <x-options></x-options>

            @endguest
        </ul>
    </div>
</div>