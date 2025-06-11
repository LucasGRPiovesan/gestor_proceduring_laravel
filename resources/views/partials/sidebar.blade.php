<div class="bg-dark border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-white">Meu Painel Admin</div>
    <div class="list-group list-group-flush">

        {{-- Item de Dashboard (direto, sem sub-itens) --}}
        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <i class="fas fa-fw fa-tachometer-alt me-2"></i> Dashboard
        </a>

        {{-- Grupo: Cadastros --}}
        <a href="#cadastroSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-white d-flex justify-content-between align-items-center">
            <div><i class="fas fa-fw fa-plus-square me-2"></i> Cadastros</div>
            <i class="fas fa-chevron-down"></i> {{-- Ícone para indicar dropdown --}}
        </a>
        <div class="collapse" id="cadastroSubmenu">
            <a href="{{ route('forms') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-file-alt me-2"></i> Formulários
            </a>
            <a href="{{ route('checklists') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-tasks me-2"></i> Checklists
            </a>
            <a href="{{ route('sheets') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-table me-2"></i> Planilhas
            </a>
            <a href="{{ route('texts') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-info-circle me-2"></i> Texto Informativo
            </a>
            <a href="{{ route('gallery') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-images me-2"></i> Galeria
            </a>
        </div>

        {{-- Grupo: Configurações --}}
        <a href="#configuracoesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-dark text-white d-flex justify-content-between align-items-center">
            <div><i class="fas fa-fw fa-cog me-2"></i> Configurações</div>
            <i class="fas fa-chevron-down"></i>
        </a>
        <div class="collapse" id="configuracoesSubmenu">
            <a href="{{ route('profiles') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-users-cog me-2"></i> Perfis
            </a>
            <a href="{{ route('users') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-user me-2"></i> Usuários
            </a>
            <a href="{{ route('logs') }}" class="list-group-item list-group-item-action bg-dark text-white ps-5">
                <i class="fas fa-fw fa-user me-2"></i> Logs
            </a>
        </div>

        {{-- Exemplo de item direto novamente, se necessário --}}
        {{-- <a href="{{ route('logout') }}" class="list-group-item list-group-item-action bg-dark text-white">
            <i class="fas fa-fw fa-sign-out-alt me-2"></i> Sair
        </a> --}}

    </div>
</div>

{{-- Você precisará do Font Awesome para os ícones --}}
{{-- Adicione esta linha no seu resources/sass/app.scss ou diretamente no <head> via CDN --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Rksm5+3xV+f3tq2s/hY3qF1/w1Q/ZlI/n9G9+f7o3K1Q/tO4/F7f6f1W7e7G1+Q/Z1W3Q/q7X6Q/w/R7C3Q/f" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}