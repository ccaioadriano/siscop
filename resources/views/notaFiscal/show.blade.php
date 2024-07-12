@extends('layouts.default')

@section('title', 'Visualizar Nota Fiscal')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            @include('layouts.partials.flash-messages')
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom text-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Nota Fiscal: <span style="color: #ffdd57">{{ $nota->id }}</span>
                            </h3>
                            <div>
                                <a href="{{ route('notaFiscal.edit', $nota->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar Nota
                                </a>
                                {{-- <a href="{{ route('documento.create', ['contrato_id' => $contrato->id]) }}" class="btn btn-primary ml-3">
                                    <i class="fas fa-file-upload"></i> Incluir Documento
                                </a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">GESTOR DO CONTRATO:</h6>
                                <p class="text-muted">CAIO</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">CONTRATADA:</h6>
                                <p class="text-muted">SUPERA</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">VALOR A SER PAGO:</h6>
                                <p class="text-muted">R$ {{ number_format($nota->valor_total, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="fw-bold mb-0">ORDENS DE SERVIÇO:</h6>
                                </div>
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nº OS:</th>
                                            <th>Nº PROCESSO</th>
                                            <th>SISTEMA</th>
                                            <th>QTD. REALIZADA</th>
                                            <th>VALOR DA OS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nota->ordensServico as $ordem)
                                            <tr>
                                                <td>{{ $ordem->id }}</td>
                                                <td>{{ $ordem->sei }}</td>
                                                <td>{{ $ordem->sistema->nome }}</td>
                                                <td>{{ $ordem->qtd_realizada . '/' . $ordem->metrica->tipo }}</td>
                                                <td>R$ {{ number_format($ordem->valor_total, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
