@extends('layouts.app')
@section('title', 'Novo Desafio')
@section('content')
    <h1>Novo Desafio</h1>
    <form action="{{ route('desafios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome_desafio" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome_desafio" id="nome_desafio" required>
        </div>
        <div class="mb-3">
            <label for="descricao_desafio" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao_desafio" id="descricao_desafio" required></textarea>
        </div>
        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Início</label>
            <input type="date" class="form-control" name="data_inicio" id="data_inicio" required>
        </div>
        <div class="mb-3">
            <label for="data_fim" class="form-label">Data de Fim</label>
            <input type="date" class="form-control" name="data_fim" id="data_fim">
        </div>
        <div class="mb-3">
            <label for="cor" class="form-label">Cor</label>
            <input type="color" class="form-control form-control-color" name="cor" id="cor" value="#000000" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection

