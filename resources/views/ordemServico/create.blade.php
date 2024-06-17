@extends('layouts.default')
@section('title', 'Cadastrar Nova Ordem de Serviço')
@section('content')
    <main class="container mt-5">
        <h2 class="text-center mb-4">Cadastrar Nova Ordem de Serviço</h2>

        <form action="{{ route('ordemServico.store') }}" method="POST">
            @csrf
            <fieldset class="row g-3">
                <legend>IDENTIFICAÇÃO</legend>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="contrato_id">Nº CONTRATO</label>
                        <input type="text" class="form-control form-control-sm @error('contrato_id') is-invalid @enderror"
                            id="contrato_id" name="contrato_id" value="{{ old('contrato_id') }}">
                        @error('contrato_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="sei">Nº PROCESSO</label>
                        <input type="text" class="form-control form-control-sm @error('sei') is-invalid @enderror"
                            id="sei" name="sei" value="{{ old('sei') }}">
                        @error('sei')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-4">
                        <label for="sistema">SISTEMA</label>
                        <input type="text" class="form-control form-control-sm @error('sistema') is-invalid @enderror"
                            id="sistema" name="sistema" value="{{ old('sistema') }}">
                        @error('sistema')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-2">
                        <label for="metrica_id">TIPO</label>
                        <select class="form-control form-control-sm @error('metrica_id') is-invalid @enderror"
                            id="metrica_id" name="metrica_id">
                            <option value="">Selecione uma métrica</option>
                            @foreach ($metricas as $metrica)
                                <option value="{{ $metrica->id }}"
                                    {{ old('metrica_id') == $metrica->id ? 'selected' : '' }}>
                                    {{ $metrica->tipo }}</option>
                            @endforeach
                        </select>
                        @error('metrica_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="qtd_realizada">QTD. REALIZADA</label>
                        <input type="text"
                            class="form-control form-control-sm @error('qtd_realizada') is-invalid @enderror"
                            id="qtd_realizada" name="qtd_realizada" value="{{ old('qtd_realizada') }}">
                        @error('qtd_realizada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <p>VALOR: R$ 10.000,00</p>
                </div>


                {{-- 
                <div class="form-group">
                    <label for="nota_id">NOTA FISCAL</label>
                    <input type="text" class="form-control form-control-sm @error('nota_id') is-invalid @enderror"
                        id="nota_id" name="nota_id" value="{{ old('nota_id') }}">
                    @error('nota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="form-group  col-md-8">
                    <textarea name="descricao" id="descricao" rows="5" placeholder="Descrição do serviço" class="form-control"></textarea>
                </div>
            </fieldset>

            <button type="submit" class="btn btn text-light bg-custom mt-3">Cadastrar</button>
        </form>
    </main>
@endsection
