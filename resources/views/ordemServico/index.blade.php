@extends('layouts.default')
@section('title', 'Ordens de Serviços')
@section('content')
    <main class="container mt-5">
        <h2 class="mb-4">Ordens de Serviço</h2>

        <!-- Botão para cadastrar nova ordem de serviço -->
        <div class="mb-4">
            <a href="{{ route('ordemServico.create') }}" class="btn btn-primary">Cadastrar Nova Ordem de Serviço</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Número</th>
                        <th>Contrato</th>
                        <th>SEI</th>
                        <th>Sistema</th>
                        <th>Realizada</th>
                        <th>Nota Fiscal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordens as $ordem)
                        <tr>
                            <td>{{ $ordem->id }}</td>
                            <td>{{ $ordem->contrato_id }}</td>
                            <td>{{ $ordem->sei }}</td>
                            <td>{{ $ordem->sistema }}</td>
                            <td>{{ $ordem->qtd_realizada . '/' . $ordem->metrica->tipo }}</td>
                            <td>
                                @if ($ordem->nota_id != null)
                                    {{ $ordem->nota_id }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
