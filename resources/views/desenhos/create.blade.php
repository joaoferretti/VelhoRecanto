@extends('layouts.app')
@section('title', 'Novo Desenho')
@section('content')
    <h1>Novo Desenho</h1>
    <form action="{{ route('desenhos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" required></textarea>
        </div>
        <div class="mb-3">
            <label for="data_criacao" class="form-label">Data</label>
            <input type="date" class="form-control" name="data_criacao" id="data_criacao" required>
        </div>
        <div class="mb-3">
            <label for="caminho_imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control @error('caminho_imagem') is-invalid @enderror" name="caminho_imagem" id="caminho_imagem" required>
            @error('caminho_imagem')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desafios_id" class="form-label">Desafio (opcional)</label>
            <select name="desafios_id" id="desafios_id" class="form-select">
                <option value="">-- Nenhum --</option>
                @foreach ($desafios as $desafio)
                    <option value="{{ $desafio->id }}">{{ $desafio->nome_desafio }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
@endsection