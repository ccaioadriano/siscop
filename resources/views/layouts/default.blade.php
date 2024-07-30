<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>SISCOP - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    @stack('styles') <!-- Para adicionar estilos específicos de páginas -->
</head>

<style>
    .bg-custom {
        background-color: #007bff;
    }

    .btn-outline-light {
        border-color: #ffffff;
        /* Borda branca */
        color: #ffffff;
        /* Texto branco */
    }

    .btn-outline-light:hover {
        background-color: #ffffff;

        color: #007bff;

    }
</style>

<body>
    <header class="bg-custom text-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo e Botão de Voltar -->
                <div class="d-flex align-items-center">
                    <!-- Botão de Voltar -->
                    <a href="javascript:history.back()" class="btn btn-outline-light d-flex align-items-center">
                        <i class="fas fa-arrow-left me-2"></i> Voltar
                    </a>
                </div>

                <!-- Navegação -->
                <nav>
                    <ul class="nav d-flex">
                        <li class="nav-item"><a class="nav-link text-white" href="/">Início</a></li>
                        <li class="nav-item"><a class="nav-link text-white"
                                href="{{ route('ordemServico.index') }}">Ordens de Serviço</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('notaFiscal.index') }}">Notas
                                Fiscais</a></li>
                        <li class="nav-item"><a class="nav-link text-white"
                                href="{{ route('contrato.index') }}">Contratos</a></li>
                    </ul>
                </nav>

                <!-- Botão de Logout -->
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Deslogar</button>
                </form>
            </div>
        </div>
    </header>

    @yield('content')

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
