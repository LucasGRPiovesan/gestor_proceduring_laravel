<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Panel - @yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles') {{-- Para CSS específico de páginas --}}
</head>
<body>
    <div id="app" class="d-flex" style="min-height: 100vh;"> {{-- d-flex para layout flexbox, min-height para ocupar toda a altura --}}

        {{-- Inclua a Barra Lateral (Sidebar) --}}
        @include('partials.sidebar')

        <div id="page-content-wrapper" class="flex-grow-1"> {{-- flex-grow-1 para o conteúdo ocupar o espaço restante --}}

            {{-- Inclua a Topbar --}}
            @include('partials.topbar')

            
            <div class="container-fluid py-4"> {{-- Container fluido para o conteúdo principal --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> --}}
                        @yield('breadcrumb')
                    </ol>
                </nav>
                @yield('content') {{-- O "miolo" da página será injetado aqui --}}
            </div>

        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts') {{-- Para JS específico de páginas --}}

    {{-- Script para toggle da sidebar (opcional, para dispositivos móveis) --}}
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('wrapper').classList.toggle('toggled');
        });
    </script>
</body>
</html>