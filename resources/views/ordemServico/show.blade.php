@extends('layouts.default')

@section('title', 'Visualizar Ordem de Serviço')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            @include('layouts.partials.flash-messages')
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom text-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Ordem de Serviço: <span
                                    style="color: #ffdd57">{{ $ordem->id }}</span></h3>
                            <div>
                                <a href="{{ route('ordemServico.edit', $ordem->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar Ordem de Serviço
                                </a>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash-alt"></i> Excluir Ordem de Serviço
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Nº CONTRATO:</h6>
                                <p class="text-muted">{{ $ordem->contrato_id }}</p>
                            </div>
                            @if ($ordem->nota_fiscal)
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Nº NOTA FISCAL:</h6>
                                    <p class="text-muted">{{ $ordem->nota_fiscal->id }}</p>
                                </div>
                            @endif
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

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir esta Ordem de Serviço?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="{{ route('ordemServico.destroy', $ordem->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
