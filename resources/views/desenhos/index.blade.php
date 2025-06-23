@extends('layouts.app')
@section('title', 'Lista de Desenhos')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Galeria de desenhos</h1>
    <a href="{{ route('desenhos.create') }}" class="btn btn-primary">Novo Desenho</a>
</div>
<form method="GET" action="{{ route('desenhos.index') }}" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Buscar título ou descrição" value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="desafio_id" class="form-select">
            <option value="">Todos os desafios</option>
            @foreach($desafios as $desafio)
                <option value="{{ $desafio->id }}" @selected(request('desafio_id') == $desafio->id)>
                    {{ $desafio->nome_desafio }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select name="sort_by" class="form-select">
            <option value="data_criacao" @selected(request('sort_by') == 'data_criacao')>Data</option>
            <option value="titulo" @selected(request('sort_by') == 'titulo')>Título</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="meus" class="form-select">
            <option value="">Todos os Desenhos</option>
            <option value="1" @selected(request('meus') == '1')>Meus Desenhos</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="direction" class="form-select">
            <option value="asc" @selected(request('direction') == 'asc')>Ascendente</option>
            <option value="desc" @selected(request('direction') == 'desc')>Descendente</option>
        </select>
    </div>
    
    <div class="col-md-1">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
</form>

{{-- LISTA DE CARDS --}}
<div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse ($desenhos as $desenho)
        <div class="col">
            <div class="card h-100 shadow-sm border-3" style="border-color: {{ $desenho->desafio->cor ?? 'sem cor' }};">
                <img src="{{ asset('storage/' . $desenho->caminho_imagem) }}" class="card-img-top" alt="Imagem de {{ $desenho->titulo }}" style="object-fit: cover; height: 200px;">
                
                {{-- Corpo do card com conteúdo fixado na base --}}
                <div class="card-body d-flex flex-column">
                    <div class="mt-auto">
                        <h5 class="card-title">{{ $desenho->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($desenho->descricao, 100) }}</p>
                        <p class="text-muted small mb-1">Data: {{ $desenho->data_criacao->format('d/m/Y') }}</p>
                        <p class="text-muted small">Desafio: {{ $desenho->desafio->nome_desafio ?? 'Nenhum' }}</p>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('desenhos.edit', $desenho) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('desenhos.destroy', $desenho) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir este desenho?')">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p>Nenhum desenho encontrado.</p>
    @endforelse
</div>


@endsection
