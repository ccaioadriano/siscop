@extends('layouts.default')

@section('title', 'Cadastrar Nova Vigencia')

@section('content')
    <main class="container mt-5">
        <h2 class="text-center mb-4">Incluir vigência</h2>

        <form action="{{ route('contrato.vigencia.store') }}" method="POST" class="row g-3">
            @csrf
            <input type="date" name="data_inicio">
            <input type="date" name="data_fim">
            <input type="text" name="contrato_id" value="{{$contrato->id}}" readonly>
            <input type="text" name="valor_ponto_funcao">
            <input type="text" name="valor_hora">
            <div class="row mt-3">
                <button type="submit" class="form-group btn text-light bg-custom mt-3 col-md-2 ms-auto">Incluir</button>
            </div>
        </form>
    </main>
@endsection
@section('scripts')
@endsection
