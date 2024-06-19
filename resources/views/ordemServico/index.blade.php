@extends('layouts.default')
@section('title', 'Ordens de Serviços')
@section('content')
    <main class="container mt-5">
        <h2 class="mb-4">Ordens de Serviço</h2>

        <!-- Formulário de Pesquisa -->
        <div class="mb-4 d-flex justify-content-end">
            <form action="{{ route('ordemServico.index') }}" method="GET" class="d-flex" style="width: 400px;">
                <input type="text" name="search" class="form-control form-control-sm me-2"
                    placeholder="Pesquisar por Nº OS, Nº CONTRATO ou SISTEMA" value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Botão para cadastrar nova ordem de serviço -->
        <div class="mb-4">
            <a href="{{ route('ordemServico.create') }}" class="btn btn text-light bg-custom">Cadastrar Nova Ordem de
                Serviço</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nº OS:</th>
                        <th>Nº CONTRATO</th>
                        <th>Nº PROCESSO</th>
                        <th>SISTEMA</th>
                        <th>QTD. REALIZADA</th>
                        <th>NOTA FISCAL</th>
                        <th>VALOR DA OS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordens as $ordem)
                        <tr data-href="{{ route('ordemServico.show', $ordem->id) }}">
                            <td>{{ $ordem->id }}</td>
                            <td>{{ $ordem->contrato_id }}</td>
                            <td>{{ $ordem->sei }}</td>
                            <td>{{ $ordem->sistema->nome }}</td>
                            <td>{{ $ordem->qtd_realizada . '/' . $ordem->metrica->tipo }}</td>
                            <td>
                                @if ($ordem->nota_id != null)
                                    {{ $ordem->nota_id }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>R$ {{ number_format($ordem->valor_total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Exibir links de paginação -->
        <div class="d-flex justify-content-center mt-4">
            {{ $ordens->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const rows = document.querySelectorAll('tr[data-href]');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
@endsection
