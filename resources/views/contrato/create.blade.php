@extends('layouts.default')

@section('title', 'Cadastrar Novo Contrato')

@section('content')
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-custom text-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Incluir Contrato</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contrato.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h6 class="fw-bold">Gestor:</h6>
                                    <select class="form-select @error('gestor_id') is-invalid @enderror" id="gestor_id"
                                        name="gestor_id">
                                        <option value="" selected disabled>Selecione o Gestor</option>
                                        @foreach ($gestores as $gestor)
                                            <option value="{{ $gestor->id }}"
                                                {{ old('gestor_id') == $gestor->id ? 'selected' : '' }}>
                                                {{ $gestor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gestor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Data de Início:</h6>
                                    <input type="date" class="form-control @error('data_inicio') is-invalid @enderror"
                                        id="data_inicio" name="data_inicio" value="{{ old('data_inicio') }}">
                                    @error('data_inicio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <h6 class="fw-bold">Data de Fim:</h6>
                                    <input type="date" class="form-control @error('data_fim') is-invalid @enderror"
                                        id="data_fim" name="data_fim" value="{{ old('data_fim') }}">
                                    @error('data_fim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <fieldset class="border rounded p-3">
                                <legend>Vigência</legend>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold">Valor por Ponto de Função:</h6>
                                        <input type="text"
                                            class="form-control @error('valor_ponto_funcao') is-invalid @enderror"
                                            id="valor_ponto_funcao" name="valor_ponto_funcao"
                                            value="{{ old('valor_ponto_funcao') }}">
                                        @error('valor_ponto_funcao')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <h6 class="fw-bold">Valor por Hora:</h6>
                                        <input type="text" class="form-control @error('valor_hora') is-invalid @enderror"
                                            id="valor_hora" name="valor_hora" value="{{ old('valor_hora') }}">
                                        @error('valor_hora')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h6 class="fw-bold">Contratada:</h6>
                                    <input type="text" class="form-control @error('contratada') is-invalid @enderror"
                                        id="contratada" name="contratada" value="{{ old('contratada') }}">
                                    @error('contratada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn text-light bg-custom">Incluir Contrato</button>
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
            $("#valor_hora").maskMoney({
                prefix: 'R$ ',
                thousands: '.',
                decimal: ',',
            })
            $("#valor_ponto_funcao").maskMoney({
                prefix: 'R$ ',
                thousands: '.',
                decimal: ',',
            })
        })
    </script>
@endsection
