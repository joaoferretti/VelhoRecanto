@extends('layouts.app')
@section('title', 'Meus Desenhos')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Meus Desenhos</h1>
        <a href="{{ route('desenhos.create') }}" class="btn btn-primary">Novo Desenho</a>
    </div>

    <div class="row">
        @foreach($desenhos as $desenho)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $desenho->caminho_imagem) }}" class="card-img-top" alt="{{ $desenho->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $desenho->titulo }}</h5>
                        <p class="card-text">{{ $desenho->descricao }}</p>
                        <p class="text-muted">{{ $desenho->data_criacao }}</p>
                        <a href="{{ route('desenhos.edit', $desenho) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('desenhos.destroy', $desenho) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection