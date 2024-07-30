@extends('layouts.default')
@section('title', 'Página Inicial')

@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1 class="display-4 mb-4">Sistema de Controle de Pagamentos</h1>
            @auth
                <p class="lead mb-4">Seja bem-vindo(a), <strong>{{ auth()->user()->name }}</strong>!</p>
            @endauth

            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Visão Geral</h5>

                            <a href="{{ route('ordemServico.index') }}" class="btn btn-primary">Ver Ordens de Serviço</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Notas Fiscais</h5>

                            <a href="{{ route('notaFiscal.index') }}" class="btn btn-primary">Ver Notas Fiscais</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Contratos</h5>

                            <a href="{{ route('contrato.index') }}" class="btn btn-primary">Ver Contratos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
