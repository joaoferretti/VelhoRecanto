@extends('layouts.app')
@section('title', 'Meus Desafios')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Meus Desafios</h1>
        <a href="{{ route('desafios.create') }}" class="btn btn-primary">Novo Desafio</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Cor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($desafios as $desafio)
                <tr>
                    <td>{{ $desafio->nome_desafio }}</td>
                    <td>{{ $desafio->descricao_desafio }}</td>
                    <td>{{ $desafio->data_inicio }}</td>
                    <td>{{ $desafio->data_fim ?? '-' }}</td>
                    <td><span style="background-color: {{ $desafio->cor }}; padding: 0.25em 0.5em; border-radius: 4px; color: white;">{{ $desafio->cor }}</span></td>
                    <td>
                        <a href="{{ route('desafios.edit', $desafio) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('desafios.destroy', $desafio) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
