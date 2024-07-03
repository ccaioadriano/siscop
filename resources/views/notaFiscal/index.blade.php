@extends('layouts.default')
@section('title', 'Notas Fiscais')
@section('content')
    <main class="container mt-5">
        <h2 class="mb-4">Notas Fiscais</h2>
        @include('layouts.partials.flash-messages')
        <!-- Formulário de Pesquisa -->
        <div class="mb-4 d-flex justify-content-end">
            <form action="{{ route('notaFiscal.index') }}" method="GET" class="d-flex" style="width: 400px;">
                <input type="text" name="search" class="form-control form-control-sm me-2"
                    placeholder="Pesquisar por Nº OS, Nº CONTRATO ou SISTEMA" value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Botão para cadastrar nova ordem de serviço -->
        <div class="mb-4">
            <a href="{{-- route('notaFiscal.create') --}}" class="btn btn text-light bg-custom">Cadastrar Nota Fiscal</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nº NOTA FISCAL:</th>
                        <th>Nº CONTRATO</th>
                        <th>DATA DE EMISSÃO</th>
                        <th>VALOR TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notas as $nota)
                        <tr data-href="{{ route('notaFiscal.show', $nota->id) }}">
                            <td>{{ $nota->id }}</td>
                            <td>{{ $nota->contrato_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($nota->data_emissao)->format('d/m/Y') }}</td>
                            <td>R$ {{ number_format($nota->valor_total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Exibir links de paginação -->
        <div class="d-flex justify-content-center mt-4">
            {{ $notas->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
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
