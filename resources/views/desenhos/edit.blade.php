@extends('layouts.app')
@section('title', 'Editar Desenho')
@section('content')
    <h1>Editar Desenho</h1>
    <form action="{{ route('desenhos.update', $desenho) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $desenho->titulo }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" required>{{ $desenho->descricao }}</textarea>
        </div>
        <div class="mb-3">
            <label for="data_criacao" class="form-label">Data</label>
            <input type="date" class="form-control" name="data_criacao" id="data_criacao" value="{{ $desenho->data_criacao->format('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="caminho_imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" name="caminho_imagem" id="caminho_imagem">
            <img src="{{ asset('storage/' . $desenho->caminho_imagem) }}" class="mt-2" width="150">
        </div>
        <div class="mb-3">
            <label for="desafios_id" class="form-label">Desafio (opcional)</label>
            <select name="desafios_id" id="desafios_id" class="form-select">
                <option value="">-- Nenhum --</option>
                @foreach ($desafios as $desafio)
                    <option value="{{ $desafio->id }}" @selected($desenho->desafios_id == $desafio->id)>
                        {{ $desafio->nome_desafio }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
