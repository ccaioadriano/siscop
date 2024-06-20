@extends('layouts.default')

@section('title', 'Editar Ordem de Serviço')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom text-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Editar Ordem de Serviço: <span
                                    style="color: #ffdd57">{{ $ordem->id }}</span></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ordemServico.update', $ordem->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Nº OS:</h6>
                                    <p class="text-muted">{{ $ordem->id }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Nº CONTRATO:</h6>
                                    <select class="form-control form-control-sm @error('contrato_id') is-invalid @enderror"
                                        id="contrato_id" name="contrato_id">
                                        <option value="">Selecione um contrato</option>
                                        @foreach ($contratos_vigentes as $contrato_vigente)
                                            <option value="{{ $contrato_vigente->id }}"
                                                {{ old('contrato_id', $ordem->contrato_id) == $contrato_vigente->id ? 'selected' : '' }}>
                                                {{ $contrato_vigente->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('contrato_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Nº PROCESSO:</h6>
                                    <input type="text"
                                        class="form-control form-control-sm @error('sei') is-invalid @enderror"
                                        id="sei" name="sei" value="{{ old('sei', $ordem->sei) }}">
                                    @error('sei')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">SISTEMA:</h6>
                                    <select class="form-control form-control-sm @error('sistema_id') is-invalid @enderror"
                                        id="sistema_id" name="sistema_id">
                                        <option value="">Selecione um sistema</option>
                                        @foreach ($sistemas as $sistema)
                                            <option value="{{ $sistema->id }}"
                                                {{ old('sistema_id', $ordem->sistema_id) == $sistema->id ? 'selected' : '' }}>
                                                {{ $sistema->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sistema_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">QTD. ESTIMADA:</h6>
                                    <input type="text"
                                        class="form-control form-control-sm @error('qtd_estimada') is-invalid @enderror"
                                        id="qtd_estimada" name="qtd_estimada"
                                        value="{{ old('qtd_estimada', $ordem->qtd_estimada) }}">
                                    @error('qtd_estimada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">QTD. REALIZADA:</h6>
                                    <input type="text"
                                        class="form-control form-control-sm @error('qtd_realizada') is-invalid @enderror"
                                        id="qtd_realizada" name="qtd_realizada"
                                        value="{{ old('qtd_realizada', $ordem->qtd_realizada) }}">
                                    @error('qtd_realizada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">VALOR DA OS:</h6>
                                    <input type="text"
                                        class="form-control form-control-sm @error('valor_total') is-invalid @enderror"
                                        id="valor_total" name="valor_total"
                                        value="{{ old('valor_total', $ordem->valor_total) }}">
                                    @error('valor_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h6 class="fw-bold">DESCRIÇÃO:</h6>
                                    <textarea class="form-control" name="descricao" id="descricao" rows="5">{{ old('descricao', $ordem->descricao) }}</textarea>
                                    @error('descricao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn text-light bg-custom">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.maskMoney.min.js') }}"></script>
@endsection
