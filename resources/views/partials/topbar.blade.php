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
                        <div class="row d-flex flex-column">
                            <div class="col-12">
                                <small>{{ Auth::user()->toFetchDTO()->name ?? 'John Doe' }}</small>
                            </div>
                            <div class="col-6">
                                <span class="badge text-bg-primary">{{ Auth::user()->toFetchDTO()->profile['profile'] }}</span>
                            </div>
                        </div>
                        <image
                            width="40" 
                            height="40" 
                            src="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/avatars/1.png"
                            style="border-radius: 100%"
                        />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Configurações</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>