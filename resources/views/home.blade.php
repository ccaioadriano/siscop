@extends('layouts.default')
@section('title', 'Página inicial')
@section('content')
    <h1 class="text-center mt-5">Sistema de Controle de Pagamentos</h1>
    @auth
        <p>Seja Bem vindo(a) {{ auth()->user()->name }}</p>
    @endauth
@section('scripts')
@endsection
@endsection
