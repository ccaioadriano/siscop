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

        <!-- Botão para cadastrar nova ordem de serviço -->
        <div class="mb-4">
            <a href="{{ route('contrato.create') }}" class="btn btn text-light bg-custom">Cadastrar Novo Contrato</a>
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
                            $ultimaVigencia = $contrato->ultimaVigencia();
                            $isExpired = $ultimaVigencia
                                ? \Carbon\Carbon::parse($ultimaVigencia->data_fim)->isPast()
                                : false;
                        @endphp
                        @if ($contrato->vigencias()->count() > 0)
                            <tr class="clickable-row {{ $isExpired ? 'table-danger' : '' }}"
                                data-href="{{ route('contrato.show', $contrato->id) }}">
                                <td>{{ $contrato->id }}</td>
                                <td>
                                    @if ($ultimaVigencia)
                                        <span
                                            class="fw-bold">{{ \Carbon\Carbon::parse($ultimaVigencia->data_inicio)->format('d/m/Y') }}</span>
                                        -
                                        <span
                                            class="fw-bold">{{ \Carbon\Carbon::parse($ultimaVigencia->data_fim)->format('d/m/Y') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($ultimaVigencia)
                                        R$ {{ number_format($ultimaVigencia->valor_ponto_funcao, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($ultimaVigencia)
                                        R$ {{ number_format($ultimaVigencia->valor_hora, 2, ',', '.') }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
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
