@extends('layouts.default')
@section('title', 'Página inicial')
@section('content')
    <h1>Seja bem vindo ao syscop</h1>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("h1").click(function() {
                $(this).hide();
            });
        });
    </script>
@endsection
@endsection
