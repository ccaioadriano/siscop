@extends('layouts.default')
@section('title', 'Ordens de Serviços')
@section('content')
    <main class="container mt-5">
        <h2 class="mb-4">Ordens de Serviço</h2>

        <!-- Botão para cadastrar nova ordem de serviço -->
        <div class="mb-4">
            <a href="{{ route('ordemServico.create') }}" class="btn btn text-light bg-custom">Cadastrar Nova Ordem de
                Serviço</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
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
                        <tr>
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
    </main>
@endsection
