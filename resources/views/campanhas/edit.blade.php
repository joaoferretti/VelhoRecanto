@extends('layouts.app')
@section('title', 'Editar Campanha')
@section('content')
    <h1>Editar Campanha</h1>
    <form action="{{ route('campanhas.update', $campanha) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $campanha->titulo }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" required>{{ $campanha->descricao }}</textarea>
        </div>
        <div class="mb-3">
            <label for="data_inicio" class="form-label">Data de Início</label>
            <input type="date" class="form-control" name="data_inicio" id="data_inicio" value="{{ $campanha->data_inicio }}" required>
        </div>
        <div class="mb-3">
            <label for="data_fim" class="form-label">Data de Fim</label>
            <input type="date" class="form-control" name="data_fim" id="data_fim" value="{{ $campanha->data_fim }}">
        </div>
        <div class="mb-3">
            <label for="tipo_objetivo" class="form-label">Tipo de Objetivo</label>
            <select name="tipo_objetivo" class="form-select" id="tipo_objetivo">
                <option value="monetario" @selected(request('tipo_objetivo') == 'monetario')>Monetário</option>
                <option value="alcance" @selected(request('tipo_objetivo') == 'alcance')>Alcance</option>
                <option value="doacoes" @selected(request('tipo_objetivo') == 'doacoes')>Doações</option>
                <option value="voluntarios" @selected(request('tipo_objetivo') == 'voluntarios')>Voluntários</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" name="objetivo" id="objetivo" class="form-control"
                placeholder="Objetivo" value="{{ $campanha->objetivo }}">
        </div>
        <div class="mb-3">
            <label for="cor" class="form-label">Cor</label>
            <input type="color" class="form-control form-control-color" name="cor" id="cor" value="{{ $campanha->cor }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>

    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipoInput = document.getElementById('tipo_objetivo');
            const valorInput = document.getElementById('objetivo');

            function updatePlaceholder() {
                switch (tipoInput.value) {
                    case 'monetario':
                        valorInput.placeholder = 'Valor em R$';
                        valorInput.type = 'number';
                        valorInput.step = '0.01';
                        valorInput.min = '0';
                        break;
                    case 'alcance':
                    case 'doacoes':
                    case 'voluntarios':
                        valorInput.placeholder = 'Número esperado';
                        valorInput.type = 'number';
                        valorInput.step = '1';
                        valorInput.min = '0';
                        break;
                    default:
                        valorInput.placeholder = 'Objetivo';
                        valorInput.type = 'text';
                }
            }

            tipoInput.addEventListener('change', updatePlaceholder);
            updatePlaceholder();
        });
    </script>
    @endpush
@endsection
