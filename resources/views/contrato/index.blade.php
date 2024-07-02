@extends('layouts.default')
@section('title', 'Contratos Vigentes')
@section('content')
    <main class="container mt-5">
        <h2 class="mb-4">Contratos</h2>
        @include('layouts.partials.flash-messages')
        <!-- Formulário de Pesquisa -->
        <div class="mb-4 d-flex justify-content-end">
            <form action="{{-- route('contrato.index') --}}" method="GET" class="d-flex" style="width: 400px;">
                <input type="text" name="search" class="form-control form-control-sm me-2"
                    placeholder="Pesquisar por Nome ou Nº Contrato">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Nº CONTRATO</th>
                        <th>VIGÊNCIA</th>
                        <th>PONTO DE FUNÇÃO</th>
                        <th>HORA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratos as $contrato)
                        @php
                            $isExpired = \Carbon\Carbon::parse($contrato->ultimaVigencia()->data_fim)->isPast();
                        @endphp
                        <tr class="clickable-row {{ $isExpired ? 'table-danger' : '' }}"
                            data-href="{{ route('contrato.show', $contrato->id) }}">
                            <td>{{ $contrato->id }}</td>
                            <td>
                                <span
                                    class="fw-bold">{{ \Carbon\Carbon::parse($contrato->ultimaVigencia()->data_inicio)->format('d/m/Y') }}</span>
                                -
                                <span
                                    class="fw-bold">{{ \Carbon\Carbon::parse($contrato->ultimaVigencia()->data_fim)->format('d/m/Y') }}</span>
                            </td>
                            <td>R$ {{ number_format($contrato->ultimaVigencia()->valor_ponto_funcao, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($contrato->ultimaVigencia()->valor_hora, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Exibir links de paginação -->
        <div class="d-flex justify-content-center mt-4">
            {{ $contratos->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
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
