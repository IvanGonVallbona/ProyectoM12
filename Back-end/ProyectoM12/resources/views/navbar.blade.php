<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Rol Lobby</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('manual*') ? 'active' : '' }}" href="{{ route('manual_list') }} ">Manuals</a>
                </li>
                
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('campanyes*') ? 'active' : '' }}" href="{{ route('campanya_list') }}">Campanyes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('personatges*') ? 'active' : '' }}" href="{{ route('personatges.index') }}">Personatges</a>
                    </li>
                    
                    @if(Auth::user()->tipus_usuari === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('esdeveniments*') ? 'active' : '' }}" href="{{ route('esdeveniments.index') }}">Esdeveniments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('classe*') ? 'active' : '' }}" href="{{ route('classe_list') }}">Classes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('raza*') ? 'active' : '' }}" href="{{ route('razas.index') }}">Razas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuaris</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('events') ? 'active' : '' }}" href="{{ route('events.index') }}">Events</a>
                        </li>
                    @endif

                @endauth
            </ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Tancar Sessió</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Inicia Sessió</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Registra't</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>