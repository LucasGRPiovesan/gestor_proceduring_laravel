@extends('layouts.app') {{-- Estende o layout principal --}}

@section('title', 'Página Inicial do Painel') {{-- Define o título específico desta página --}}

@section('content') {{-- Começa a seção do "miolo" --}}
    <div class="container">
        <h1>Bem-vindo ao Painel!</h1>
        <p>Este é o conteúdo específico da sua página de dashboard.</p>
        <p>Você pode adicionar gráficos, tabelas, e outras informações aqui.</p>
    </div>
@endsection {{-- Termina a seção do "miolo" --}}