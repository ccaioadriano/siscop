@extends('layouts.default')

@section('title', 'Cadastrar Nova Ordem de Serviço')

@section('content')
    <main class="container mt-5">
        <h2 class="text-center mb-4">Cadastrar Nova Ordem de Serviço</h2>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Valor das métricas</h5>
                        <p class="card-text">PF: <span id="ponto_funcao_label" style="color: red">R$ 0,00</span></p>
                        <p class="card-text">HR: <span id="hora_label" style="color: red">R$ 0,00</span></p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('ordemServico.store') }}" method="POST" class="row g-3">
            @csrf

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="contrato_id" class="fw-bold">Nº CONTRATO</label>
                    <select class="form-control form-control-sm @error('contrato_id') is-invalid @enderror" id="contrato_id"
                        name="contrato_id">
                        <option value="">Selecione um contrato</option>
                        @foreach ($contratos_vigentes as $contrato_vigente)
                            <option value="{{ $contrato_vigente->id }}"
                                {{ old('contrato_id') == $contrato_vigente->id ? 'selected' : '' }}>
                                {{ $contrato_vigente->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('contrato_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold">NOTA FISCAL:</h6>
                    <select class="form-control form-control-sm @error('nota_id') is-invalid @enderror" id="nota_id"
                        name="nota_id">
                        <option value="">Selecione uma nota fiscal</option>
                        @foreach ($notas_fiscais as $nota)
                            <option value="{{ $nota->id }}">
                                {{ $nota->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('nota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="sei" class="fw-bold">Nº PROCESSO</label>
                    <input type="text" class="form-control form-control-sm @error('sei') is-invalid @enderror"
                        id="sei" name="sei" value="{{ old('sei') }}">
                    @error('sei')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group col-md-4">
                    <label for="sistema" class="fw-bold">SISTEMA</label>
                    <select class="form-control form-control-sm @error('sistema_id') is-invalid @enderror" id="sistema_id"
                        name="sistema_id">
                        <option value="">Selecione um sistema</option>
                        @foreach ($sistemas as $sistema)
                            <option value="{{ $sistema->id }}" {{ old('sistema_id') == $sistema->id ? 'selected' : '' }}>
                                {{ $sistema->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('sistema_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <fieldset class="border rounded p-3">
                <legend>Calcular estimativa</legend>
                <div class="row mt-3 gap-5">
                    <div class="form-group col-md-4">
                        <label for="metrica_id" class="fw-bold">TIPO</label>
                        <select class="form-control form-control-sm @error('metrica_id') is-invalid @enderror"
                            id="metrica_id" name="metrica_id">
                            <option value="">Selecione uma métrica</option>
                            @foreach ($metricas as $metrica)
                                <option value="{{ $metrica->id }}"
                                    {{ old('metrica_id') == $metrica->id ? 'selected' : '' }}>
                                    {{ $metrica->tipo }}
                                </option>
                            @endforeach
                        </select>
                        @error('metrica_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="qtd_estimada" class="fw-bold">QTD. ESTIMADA</label>
                        <input type="text"
                            class="form-control form-control-sm @error('qtd_estimada') is-invalid @enderror"
                            id="qtd_estimada" name="qtd_estimada" value="{{ old('qtd_estimada') }}">
                        @error('qtd_estimada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2 align-self-end">
                        <button type="button" class="btn text-light bg-custom" id="calcularBtn">Calcular</button>
                    </div>
                </div>

                <div class="row mt-3 gap-5">

                    <div class="form-group col-md-4">
                        <label class="fw-bold">VALOR ESTIMADO:</label>
                        <input type="text" id="valorTotal" name="valor_total" class="form-control form-control-sm"
                            value="{{ old('valor_total') }}" readonly></input>
                    </div>

                </div>
            </fieldset>

            <div class="form-group col-md-9 mt-3">
                <label for="descricao" class="fw-bold">DESCRIÇÃO</label>
                <textarea name="descricao" id="descricao" rows="5" class="form-control"></textarea>
            </div>

            <div class="row mt-3">
                <button type="submit" class="form-group btn text-light bg-custom mt-3 col-md-2 ms-auto">Cadastrar</button>
            </div>
        </form>
    </main>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#calcularBtn').on('click', function() {
                // Requisição AJAX para calcular o valor
                var metrica_id = $('#metrica_id').val();
                var contrato_id = $('#contrato_id').val() != null ? $('#contrato_id').val() : 0;
                var qtd_estimada = $('#qtd_estimada').val();

                $.ajax({
                    // Rota para o cálculo
                    url: '{{ route('ordemServico.calcularMetrica') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        metrica_id: metrica_id,
                        qtd_estimada: qtd_estimada,
                        contrato_id: contrato_id
                    },
                    success: function(response) {
                        if (response.valor_total && response.valor_total != undefined) {
                            $('#valorTotal').val(response.valor_total);
                        } else {
                            $('#valorTotal').val('R$ 0,00');
                        }
                    },
                    error: function(xhr) {
                        $('#valorTotal').val('R$ 0,00');
                        console.log(xhr.responseJSON.message);
                        alert(xhr.responseJSON.message);
                    }
                });
            });

            //busca os valores do contrato
            $('#contrato_id').change(function() {
                var contrato_id = $(this).val(); // Pega o valor do número do contrato selecionado


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

        });
    </script>
@endsection
