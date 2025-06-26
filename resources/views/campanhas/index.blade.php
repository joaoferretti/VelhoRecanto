@extends('layouts.app')
@section('title', 'Minhas Campanhas')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Campanhas</h1>
        @auth
        <a href="{{ route('campanhas.create') }}" class="btn btn-primary">Nova Campanha</a>
        @endauth
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Tipo Objetivo</th>
                <th>Objetivo</th>
                @auth
                <th>Cor</th>
                <th>Ações</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($campanhas as $campanha)
                <tr>
                    <td>{{ $campanha->titulo }}</td>
                    <td>{{ $campanha->descricao }}</td>
                    <td>{{ $campanha->data_inicio }}</td>
                    <td>{{ $campanha->data_fim ?? '-' }}</td>
                    <td>{{ $campanha->tipo_objetivo ?? '-' }}</td>
                    <td>{{ $campanha->objetivo ?? '-' }}</td>
                    @auth
                    <td>
                        <span style="background-color: {{ $campanha->cor }}; padding: 0.25em 0.5em; border-radius: 4px; color: white;">
                            {{ $campanha->cor }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('campanhas.edit', $campanha) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('campanhas.destroy', $campanha) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
