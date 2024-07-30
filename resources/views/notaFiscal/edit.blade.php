@extends('layouts.default')

@section('title', 'Editar Nota Fiscal')

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
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('notaFiscal.update', $nota->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <h6 class="fw-bold">GESTOR DO CONTRATO:</h6>
                                    <input type="text" name="gestor" class="form-control"
                                        value="{{ old('gestor', $nota->contrato->gestor->name) }}" disabled>
                                </div>

                                <div class="col-md-4">
                                    <h6 class="fw-bold">DATA DE EMISSÃO</h6>
                                    <input type="date" name="data_emissao" class="form-control"
                                        value="{{ old('data_emissao', $nota->data_emissao) }}">
                                </div>
                                <div class="col-md-4">
                                    <h6 class="fw-bold">CONTRATADA:</h6>
                                    <input type="text" name="contratada" class="form-control"
                                        value="{{ old('contratada', $nota->contrato->contratada) }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">VALOR A SER PAGO:</h6>
                                    <input name="valor_total" class="form-control" id="valor_total"
                                        value="R$ {{ old('valor_total', number_format($nota->valor_total, 2, ',', '.')) }}"
                                        disabled>
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
                                                <th>MÉTRICA</th>
                                                <th>VALOR DA OS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($nota->ordensServico as $ordem)
                                                <tr>
                                                    <td>{{ $ordem->id }}</td>
                                                    <td>{{ $ordem->sei }}</td>
                                                    <td>{{ $ordem->sistema->nome }}</td>
                                                    <td>{{ $ordem->qtd_realizada }}</td>
                                                    <td>{{ $ordem->metrica->tipo }}</td>
                                                    <td>R$ {{ number_format($ordem->valor_total, 2, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
