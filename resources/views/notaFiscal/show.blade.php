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
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash-alt"></i> Excluir Nota Fiscal
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <h6 class="fw-bold">GESTOR DO CONTRATO:</h6>
                                <p class="text-muted">{{ $nota->contrato->gestor->name }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="fw-bold">DATA DE EMISSÃO:</h6>
                                <p class="text-muted">{{ \Carbon\Carbon::parse($nota->data_emissao)->format('d/m/Y') }}</p>
                            </div>
                            @if ($nota->contrato->contratada)
                                <div class="col-md-4">
                                    <h6 class="fw-bold">CONTRATADA:</h6>
                                    <p class="text-muted">{{ $nota->contrato->contratada }}</p>
                                </div>
                            @endif
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

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja excluir esta Nota Fiscal?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="{{ route('notaFiscal.destroy', $nota->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
