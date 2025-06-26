@extends('layouts.app')
@section('title', 'Lista de Ações')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Lista de Ações</h1>
    @auth
    <a href="{{ route('acoes.create') }}" class="btn btn-primary">Nova Ação</a>
    @endauth
</div>
@auth
<form method="GET" action="{{ route('acoes.index') }}" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Buscar título ou descrição" value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="campanha_id" class="form-select">
            <option value="">Todas as campanhas</option>
            @if(isset($campanhas) && $campanhas->count())
                @foreach($campanhas as $campanha)
                    <option value="{{ $campanha->id }}" @selected(request('campanha_id') == $campanha->id)>
                        {{ $campanha->titulo }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="col-md-2">
        <select name="sort_by" class="form-select">
            <option value="data" @selected(request('sort_by') == 'data')>Data</option>
            <option value="titulo" @selected(request('sort_by') == 'titulo')>Título</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="meus" class="form-select">
            <option value="">Todas as Ações</option>
            <option value="1" @selected(request('meus') == '1')>Minhas Ações</option>
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
@endauth
{{-- LISTA DE CARDS --}}
<div class="row row-cols-1 row-cols-md-3 g-4">
    @if(isset($acoes) && $acoes->count())
        @forelse ($acoes as $acao)
            <div class="col">
                <div class="card h-100 shadow-sm border-3" style="border-color: {{ $acao->campanha->cor ?? '#ccc' }};">
                    @if($acao->caminho_imagem)
                        <img src="{{ asset('storage/' . $acao->caminho_imagem) }}" class="card-img-top" alt="Imagem de {{ $acao->titulo }}" style="object-fit: cover; height: 200px;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="mt-auto">
                            <h5 class="card-title">{{ $acao->titulo }}</h5>
                            <p class="card-text">{{ Str::limit($acao->descricao, 100) }}</p>
                            <p class="text-muted small mb-1">Data: {{ \Carbon\Carbon::parse($acao->data)->format('d/m/Y') }}</p>
                            <p class="text-muted small">Campanha: {{ $acao->campanha->titulo ?? 'Nenhuma' }}</p>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        @auth
                        <a href="{{ route('acoes.edit', $acao) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('acoes.destroy', $acao) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta ação?')">Excluir</button>
                        </form>
                        @endauth
                        <a href="{{ route('acoes.show', $acao) }}" class="btn btn-sm btn-warning">Ajudar</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Nenhuma ação encontrada.</p>
        @endforelse
    @endif
</div>

@endsection
