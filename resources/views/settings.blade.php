@extends('layouts.app')

@section('title', 'Configurações do Sistema')

@section('content')
    <div class="container">
        <h1>Configurações</h1>
        <p>Aqui você pode ajustar as configurações do seu sistema.</p>
        <form>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control">
            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>
    </div>
@endsection