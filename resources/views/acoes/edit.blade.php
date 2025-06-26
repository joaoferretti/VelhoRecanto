@extends('layouts.app')
@section('title', 'Editar Ação')
@section('content')
    <h1>Editar Ação</h1>
    <form action="{{ route('acoes.update', $acao) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $acao->titulo }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" required>{{ $acao->descricao }}</textarea>
        </div>
        <div class="mb-3">
            <label for="data_criacao" class="form-label">Data</label>
            <input type="date" class="form-control" name="data_criacao" id="data_criacao" value="{{ $acao->data_criacao }}" required>
        </div>
        <div class="mb-3">
            <label for="caminho_imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" name="caminho_imagem" id="caminho_imagem">
            <img src="{{ asset('storage/' . $acao->caminho_imagem) }}" class="mt-2" width="150">
        </div>
        <div class="mb-3">
            <label for="campanha_id" class="form-label">Campanha (opcional)</label>
            <select name="campanha_id" id="campanha_id" class="form-select">
                <option value="">-- Nenhuma --</option>
                @foreach ($campanhas as $campanha)
                    <option value="{{ $campanha->id }}" @selected($acao->campanha_id == $campanha->id)>
                        {{ $campanha->titulo }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="valor_alcancado" class="form-label">Valor Alcançado (opcional)</label>
            <input type="integer" name="valor_alcancado" id="valor_alcancado" class="form-control"
            placeholder="Valor Alcançado" value="{{ request('valor_alcancado') }}">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
