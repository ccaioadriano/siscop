@extends('layouts.default')
@section('title', 'Cadastrar Nova Ordem de Serviço')
@section('content')
    <main class="container mt-5">
        <h2 class="text-center mb-4">Cadastrar Nova Ordem de Serviço</h2>

        <form action="{{ route('ordemServico.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="contrato_id">Número do Contrato</label>
                <input type="text" class="form-control @error('contrato_id') is-invalid @enderror" id="contrato_id"
                    name="contrato_id" value="{{ old('contrato_id') }}">
                @error('contrato_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="sei">SEI</label>
                <input type="text" class="form-control @error('sei') is-invalid @enderror" id="sei" name="sei"
                    value="{{ old('sei') }}">
                @error('sei')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="sistema">Sistema</label>
                <input type="text" class="form-control @error('sistema') is-invalid @enderror" id="sistema"
                    name="sistema" value="{{ old('sistema') }}">
                @error('sistema')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="qtd_estimada">Quantidade Estimada</label>
                <input type="text" class="form-control @error('qtd_estimada') is-invalid @enderror"
                    id="qtd_estimada" name="qtd_estimada" value="{{ old('qtd_estimada') }}">
                @error('qtd_estimada')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="qtd_realizada">Quantidade Realizada</label>
                <input type="text" class="form-control @error('qtd_realizada') is-invalid @enderror"
                    id="qtd_realizada" name="qtd_realizada" value="{{ old('qtd_realizada') }}">
                @error('qtd_realizada')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="metrica_id">Métrica</label>
                <select class="form-control @error('metrica_id') is-invalid @enderror" id="metrica_id" name="metrica_id"
                    required>
                    <option value="">Selecione uma métrica</option>
                    @foreach ($metricas as $metrica)
                        <option value="{{ $metrica->id }}" {{ old('metrica_id') == $metrica->id ? 'selected' : '' }}>
                            {{ $metrica->tipo }}</option>
                    @endforeach
                </select>
                @error('metrica_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nota_id">Nota Fiscal</label>
                <input type="text" class="form-control @error('nota_id') is-invalid @enderror" id="nota_id"
                    name="nota_id" value="{{ old('nota_id') }}">
                @error('nota_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </main>
@endsection
