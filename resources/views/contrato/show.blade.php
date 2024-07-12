@extends('layouts.default')

@section('title', 'Visualizar Contrato')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            @include('layouts.partials.flash-messages')
            <div class="col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom text-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Contrato: <span style="color: #ffdd57">{{ $contrato->id }}</span></h3>
                            <div>
                                <a href="{{-- route('contrato.edit', $contrato->id) --}}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar Contrato
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
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="fw-bold mb-0">VIGÊNCIAS:</h6>
                                </div>
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>DATA</th>
                                            <th>VALOR PONTO DE FUNÇÃO</th>
                                            <th>VALOR HORA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contrato->vigencias as $vigencia)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($vigencia->data_inicio)->format('d/m/Y') }} -
                                                    {{ \Carbon\Carbon::parse($vigencia->data_fim)->format('d/m/Y') }}</td>
                                                <td>R$ {{ number_format($vigencia->valor_ponto_funcao, 2, ',', '.') }}</td>
                                                <td>R$ {{ number_format($vigencia->valor_hora, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <a href="{{ route('contrato.vigencia.create', $contrato->id) }}" class="btn btn-success col-md-2 ms-auto me-3">
                                        <i class="fas fa-plus"></i> Adicionar Vigência
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
