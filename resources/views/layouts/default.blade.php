<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>SISCOP - @yield('title')</title>
    <meta charset="utf-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
</head>

<body>
    <header class="bg-custom text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1 class="h3 mb-0">SISCOP</h1>
            </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-white" href="/">Início</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('ordemServico.index') }}">Ordens
                            de Serviço</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('notaFiscal.index') }}">Notas
                            Fiscais</a></li>
                    <li class="nav-item"><a class="nav-link text-white"
                            href="{{ route('contrato.index') }}">Contratos</a></li>
                </ul>
            </nav>
        </div>
    </header>
    @yield('content')
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
