@extends('layouts.default')

@section('title', 'Visualizar Ordem de Serviço')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom text-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Ordem de Serviço: <span
                                    style="color: #ffdd57">{{ $ordem->id }}</span></h3>
                            <a href="{{ route('ordemServico.edit', $ordem->id) }}" style="color: #ffdd57">
                                <i class="fas fa-edit"></i></a>
                        </div>
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
                                <h6 class="fw-bold">QTD. ESTIMADA:</h6>
                                <p class="text-muted">{{ $ordem->qtd_estimada . ' ' . $ordem->metrica->tipo }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">QTD. REALIZADA:</h6>
                                <p class="text-muted">{{ $ordem->qtd_realizada . ' ' . $ordem->metrica->tipo }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">VALOR DA OS:</h6>
                                <p class="text-muted">R$ {{ number_format($ordem->valor_total, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        @if ($ordem->descricao)
                            <hr>
                            <div class="row">
                                <h6 class="fw-bold">DESCRIÇÃO:</h6>
                                <p class="text-muted">{{ $ordem->descricao }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
