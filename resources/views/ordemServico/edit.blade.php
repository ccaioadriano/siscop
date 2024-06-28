@extends('layouts.default')

@section('title', 'Editar Ordem de Serviço')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Valor das métricas</h5>
                            <p class="card-text">PF: <span id="ponto_funcao_label" style="color: red">R$
                                    {{ number_format($ordem->contrato->valor_ponto_funcao, 2, ',', '.') }}</span>
                            </p>
                            <p class="card-text">HR: <span id="hora_label" style="color: red">R$
                                    {{ number_format($ordem->contrato->valor_hora, 2, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <h6 class="fw-bold">MÉTRICA:</h6>
                                    <select class="form-control form-control-sm @error('metrica_id') is-invalid @enderror"
                                        id="metrica_id" name="metrica_id">
                                        @foreach ($metricas as $metrica)
                                            <option value="{{ $metrica->id }}"
                                                {{ old('metrica_id', $ordem->metrica_id) == $metrica->id ? 'selected' : '' }}>
                                                {{ $metrica->tipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('metrica_id')
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
                                        value="R$ {{ old('valor_total', $ordem->valor_total) }}" readonly>
                                </div>
                                <div class="col-md-2 align-self-end">
                                    <button type="button" class="btn text-light bg-custom"
                                        id="calcularBtn">Calcular</button>
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
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            var contrato_id = $('#contrato_id').val() != null ? $('#contrato_id').val() : null;
            var metrica_id = $('#metrica_id').val();
            var qtd_realizada = $('#qtd_realizada').val() > 0 ? $('#qtd_realizada').val() : $('#qtd_estimada')
        .val();

            $.ajax({
                url: '{{ route('contrato.getValores') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    contrato_id: contrato_id,
                },
                success: function(response) {
                    // Atualiza os valores na tela conforme necessário
                    if (response.valorPF && response.valorHR != undefined) {
                        $('#ponto_funcao_label').text(response.valorPF);
                        $('#hora_label').text(response.valorHR);
                    } else {
                        $('#ponto_funcao_label').text('R$ 0,00');
                        $('#hora_label').text('R$ 0,00');
                    }
                },
                error: function(xhr) {
                    $('#ponto_funcao_label').text('R$ 0,00');
                    $('#hora_label').text('R$ 0,00');
                    console.log(xhr.responseJSON.message);
                    alert(xhr.responseJSON.message);
                }
            });


            $.ajax({
                // Rota para o cálculo
                url: '{{ route('ordemServico.calcularMetrica') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    metrica_id: metrica_id,
                    qtd_realizada: qtd_realizada,
                    contrato_id: contrato_id
                },
                success: function(response) {
                    $('#valor_total').val(response.valor_total);
                },
                error: function(xhr) {
                    $('#valor_total').val('R$ 0,00');
                    console.log(xhr.responseJSON.message);
                    alert(xhr.responseJSON.message);
                }
            });
        });

        $('#calcularBtn').on('click', function() {
            // Requisição AJAX para calcular o valor
            var metrica_id = $('#metrica_id').val();
            var contrato_id = $('#contrato_id').val() != null ? $('#contrato_id').val() : 0;
            var qtd_realizada = $('#qtd_realizada').val() > 0 ? $('#qtd_realizada').val() : $('#qtd_estimada')
                .val();

            $.ajax({
                // Rota para o cálculo
                url: '{{ route('ordemServico.calcularMetrica') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    metrica_id: metrica_id,
                    qtd_realizada: qtd_realizada,
                    contrato_id: contrato_id
                },
                success: function(response) {
                    $('#valor_total').val(response.valor_total);
                },
                error: function(xhr) {
                    $('#valor_total').val('R$ 0,00');
                    console.log(xhr.responseJSON.message);
                    alert(xhr.responseJSON.message);
                }
            });
        });
        $('#contrato_id').change(function() {
            var contrato_id = $(this).val();
            var metrica_id = $('#metrica_id').val();
            var qtd_realizada = $('#qtd_realizada').val() > 0 ? $('#qtd_realizada').val() : $('#qtd_estimada')
                .val();

            $.ajax({
                // Rota para o cálculo
                url: '{{ route('ordemServico.calcularMetrica') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    metrica_id: metrica_id,
                    qtd_realizada: qtd_realizada,
                    contrato_id: contrato_id
                },
                success: function(response) {
                    $('#valor_total').val(response.valor_total);
                },
                error: function(xhr) {
                    $('#valor_total').val('R$ 0,00');
                    console.log(xhr.responseJSON.message);
                    alert(xhr.responseJSON.message);
                }
            });

            // Pega o valor do número do contrato selecionado
            $.ajax({
                url: '{{ route('contrato.getValores') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    contrato_id: contrato_id,
                },
                success: function(response) {
                    // Atualiza os valores na tela conforme necessário
                    if (response.valorPF && response.valorHR != undefined) {
                        $('#ponto_funcao_label').text(response.valorPF);
                        $('#hora_label').text(response.valorHR);
                    } else {
                        $('#ponto_funcao_label').text('R$ 0,00');
                        $('#hora_label').text('R$ 0,00');
                    }
                },
                error: function(xhr) {
                    $('#ponto_funcao_label').text('R$ 0,00');
                    $('#hora_label').text('R$ 0,00');
                    console.log(xhr.responseJSON.message);
                    alert(xhr.responseJSON.message);
                }
            });
        });

        $('#sei').inputmask('9999.99.9999999/9999-99')
    </script>




@endsection
