<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Projecte Final M12</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('classe_list') }}">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('campanya_list') }}">Campanyes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=>Personatges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('esdeveniments.index') }}">Esdeveniments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manual_list') }} ">Manuals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('registre_list') }}">Registre Sessións</a>
                </li>
               
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
                        <a class="nav-link" href="{{ route('login') }}">Inicia Sessió</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registra't</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>