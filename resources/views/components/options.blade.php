
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Cuenta
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a
            class="dropdown-item"
            href="{{ route('logout') }}"
            onclick="event.preventDefault();
            window.localStorage.clear();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <a
            class="dropdown-item"
            href="{{ route('profile', Auth::user()->id) }}">Perfil
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
