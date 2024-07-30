@extends('layouts.default')

@section('title', 'Cadastrar Nova Vigência')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom text-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Incluir Vigência</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contrato.vigencia.store') }}" method="POST" id="createForm">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Nº CONTRATO:</h6>
                                    <input type="text" class="form-control-plaintext" id="contrato_id" name="contrato_id"
                                        value="{{ $contrato->id }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">DATA INICIO:</h6>
                                    <input type="date"
                                        class="form-control form-control-sm @error('data_inicio') is-invalid @enderror"
                                        id="data_inicio" name="data_inicio" value="{{ old('data_inicio', date('Y-m-d')) }}">
                                    @error('data_inicio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">DATA FIM:</h6>
                                    <input type="date"
                                        class="form-control form-control-sm @error('data_fim') is-invalid @enderror"
                                        id="data_fim" name="data_fim" value="{{ old('data_fim', date('Y-m-d')) }}">
                                    @error('data_fim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">VALOR HORA:</h6>
                                    <input type="text"
                                        class="form-control form-control-sm @error('valor_hora') is-invalid @enderror"
                                        id="valor_hora" name="valor_hora" value="{{ old('valor_hora') }}">
                                    @error('valor_hora')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">VALOR PONTO DE FUNÇÃO:</h6>
                                    <input type="text"
                                        class="form-control form-control-sm @error('valor_ponto_funcao') is-invalid @enderror"
                                        id="valor_ponto_funcao" name="valor_ponto_funcao"
                                        value="{{ old('valor_ponto_funcao') }}">
                                    @error('valor_ponto_funcao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn text-light bg-custom">Incluir</button>
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
    <script>
        $(document).ready(function() {
            // Inicializando a máscara de dinheiro
            $("#valor_hora, #valor_ponto_funcao").maskMoney({
                prefix: 'R$ ',
                thousands: '.',
                decimal: ',',
            });

        });
        $("#createForm").submit(function() {
            $("#valor_hora, #valor_ponto_funcao").each(function() {
                var value = $(this).maskMoney('unmasked')[0];
                $(this).val(value);
            });
        });
    </script>
@endsection
