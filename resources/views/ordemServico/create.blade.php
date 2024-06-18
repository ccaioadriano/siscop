@extends('layouts.default')

@section('title', 'Cadastrar Nova Ordem de Serviço')

@section('content')
    <main class="container mt-5">
        <h2 class="text-center mb-4">Cadastrar Nova Ordem de Serviço</h2>

        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Valor das métricas</h5>
                        <p class="card-text">PF: R$ 10,00</p>
                        <p class="card-text">HR: R$ 5,00</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('ordemServico.store') }}" method="POST">
            @csrf
            <fieldset class="row g-3">
                <legend class="fw-bold">IDENTIFICAÇÃO</legend>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="contrato_id" class="fw-bold">Nº CONTRATO</label>
                        <input type="text"
                            class="form-control form-control-sm @error('contrato_id') is-invalid @enderror" id="contrato_id"
                            name="contrato_id" value="{{ old('contrato_id') }}">
                        @error('contrato_id')
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
                        <input type="text" class="form-control form-control-sm @error('sistema') is-invalid @enderror"
                            id="sistema" name="sistema" value="{{ old('sistema') }}">
                        @error('sistema')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-2">
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

                    <div class="form-group col-md-2">
                        <label for="qtd_realizada" class="fw-bold">QTD. REALIZADA</label>
                        <input type="text"
                            class="form-control form-control-sm @error('qtd_realizada') is-invalid @enderror"
                            id="qtd_realizada" name="qtd_realizada" value="{{ old('qtd_realizada') }}">
                        @error('qtd_realizada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-2 align-self-end">
                        <button type="button" class="btn btn-primary" id="calcularBtn">Calcular</button>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-2">
                        <label class="fw-bold">VALOR:</label>
                        <p id="valorCalculado" class="fw-bold">R$ 0,00</p>
                    </div>
                </div>

                <div class="form-group col-md-8 mt-3">
                    <label for="descricao" class="fw-bold">Descrição do serviço</label>
                    <textarea name="descricao" id="descricao" rows="5" class="form-control"></textarea>
                </div>
            </fieldset>

            <button type="submit" class="btn btn text-light bg-custom mt-3">Cadastrar</button>
        </form>
    </main>

    <script>
        $(document).ready(function() {
            $('#calcularBtn').on('click', function() {
                // Requisição AJAX para calcular o valor
                var metricaId = $('#metrica_id').val();
                var qtdRealizada = $('#qtd_realizada').val();

                $.ajax({
                     // Rota para o cálculo
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        metrica_id: metricaId,
                        qtd_realizada: qtdRealizada
                    },
                    success: function(response) {
                        $('#valorCalculado').text('R$ ' + response.valor);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
