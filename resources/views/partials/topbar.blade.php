<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        {{-- Botão para esconder/mostrar a sidebar (para mobile)
        <button class="btn btn-primary" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button> --}}

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default_avatar.png') }}" class="rounded-circle me-1" alt="Avatar" style="width: 30px; height: 30px;"> --}}
                        <div>
                            {{ Auth::user()->name ?? 'John Doe' }}</br>
                            <span class="badge text-bg-primary">Admin</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        {{-- <a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a> --}}
                        <a class="dropdown-item" href="#">Configurações</a>
                        <a class="dropdown-item" href="#">Sair</a>
                        {{-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('login') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('login') }}" method="POST" class="d-none">
                            @csrf
                        </form> --}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>