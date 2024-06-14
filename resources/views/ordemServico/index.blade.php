@extends('layouts.default')
@section('title', 'Ordens de Serviços')
@section('content')
    <main class="container mt-5">
        <h2 class="mb-4">Ordens de Serviço</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>CONTRATO</th>
                        <th>SEI</th>
                        <th>SISTEMA</th>
                        <th>REALIZADA</th>
                        <th>NOTA FISCAL</th>
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
                            @if ($ordem->nota_id != null)
                                <td>{{ $ordem->nota_id }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection
