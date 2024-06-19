@extends('layouts.default')

@section('title', 'Visualizar Ordem de Serviço')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-custom text-light">
                        <h3 class="card-title mb-0">Ordem de Serviço: <span style="color: #ffdd57">{{ $ordem->id }}</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Nº OS:</h6>
                                <p class="text-muted">{{ $ordem->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Nº CONTRATO:</h6>
                                <p class="text-muted">{{ $ordem->contrato_id }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Nº PROCESSO:</h6>
                                <p class="text-muted">{{ $ordem->sei }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">SISTEMA:</h6>
                                <p class="text-muted">{{ $ordem->sistema->nome }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">QTD. REALIZADA:</h6>
                                <p class="text-muted">{{ $ordem->qtd_realizada . '/' . $ordem->metrica->tipo }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">NOTA FISCAL:</h6>
                                <p class="text-muted">
                                    @if ($ordem->nota_id != null)
                                        {{ $ordem->nota_id }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">VALOR DA OS:</h6>
                                <p class="text-muted">R$ {{ number_format($ordem->valor_total, 2, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">DESCRIÇÃO:</h6>
                                <p class="text-muted">{{ $ordem->descricao }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
