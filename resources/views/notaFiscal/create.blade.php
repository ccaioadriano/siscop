@extends('layouts.default')

@section('title', 'Cadastrar Nota Fiscal')

@section('content')
    <main class="container mt-5">
        <h2 class="text-center mb-4">Cadastrar Nota Fiscal</h2>

        <form action="{{ route('notaFiscal.store') }}" method="POST" class="row g-3">
            @csrf

            <div class="row">
                <div class="form-group col-md-6">
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

                <div class="form-group col-md-6">
                    <label for="data_emissao" class="fw-bold">DATA DE EMISSÃO</label>
                    <input type="date" class="form-control form-control-sm @error('data_emissao') is-invalid @enderror"
                        id="data_emissao" name="data_emissao" value="{{ old('data_emissao', date('Y-m-d')) }}">
                    @error('data_emissao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <button type="submit" class="form-group btn text-light bg-custom mt-3 col-md-2 ms-auto">Cadastrar</button>
            </div>
        </form>
    </main>
@endsection

@section('scripts')
   
@endsection
