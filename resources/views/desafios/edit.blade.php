@extends('layouts.app')
@section('title', 'Editar Desafio')
@section('content')
    <h1>Editar Desafio</h1>
    <form action="{{ route('desafios.update', $desafio) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nome_desafio" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome_desafio" id="nome_desafio" value="{{ $desafio->nome_desafio }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao_desafio" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao_desafio" id="descricao_desafio" required>{{ $desafio->descricao_desafio }}</textarea>
        </div>
        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Início</label>
            <input type="date" class="form-control" name="data_inicio" id="data_inicio" value="{{ $desafio->data_inicio }}" required>
        </div>
        <div class="mb-3">
            <label for="data_fim" class="form-label">Data de Fim</label>
            <input type="date" class="form-control" name="data_fim" id="data_fim" value="{{ $desafio->data_fim }}">
        </div>
        <div class="mb-3">
            <label for="cor" class="form-label">Cor</label>
            <input type="color" class="form-control form-control-color" name="cor" id="cor" value="{{ $desafio->cor }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection