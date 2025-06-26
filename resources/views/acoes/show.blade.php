@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-md mt-10 text-center">

    {{-- Imagem em estilo capa/thumbnail --}}
    <div class="w-full h-64 overflow-hidden rounded-xl shadow-sm">
        <img src="{{ asset('storage/' . $acao->caminho_imagem) }}"
             alt="{{ $acao->titulo }}"
             class="w-full h-full object-cover object-center">
    </div>

    {{-- Título centralizado --}}
    <h1 class="text-4xl font-extrabold text-gray-800 mt-6">{{ $acao->titulo }}</h1>

    {{-- Cálculo da campanha --}}
    @php
        if ($acao->campanha) {
            $meta = $acao->campanha->objetivo ?? 1;
            $arrecadado = $acao->campanha->acoes->sum('valor_alcancado');
            $porcentagem = min(100, round(($arrecadado / $meta) * 100, 2));
        } else {
            $meta = 1;
            $arrecadado = 0;
            $porcentagem = 0;
        }
    @endphp

    {{-- Barra de progresso centralizada --}}
    <div class="mt-6 mx-auto w-full">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-green-500 h-4 rounded-full transition-all duration-500"
                 style="width: {{ $porcentagem }}%"></div>
        </div>
        <p class="text-sm text-gray-600 mt-1">
            <strong>{{ $porcentagem }}%</strong> arrecadado — R$ {{ number_format($arrecadado, 2, ',', '.') }}
            de R$ {{ number_format($meta, 2, ',', '.') }}
        </p>
    </div>

    {{-- Botão primário centralizado --}}
    <div class="mt-6 flex justify-center">
        <a href="#doar"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold text-lg px-8 py-3 rounded-full shadow-md transition !important">
           Quero ajudar 💚
        </a>
    </div>
    <div class="bg-red-500 text-white p-2">Teste Tailwind</div>

    {{-- Descrição --}}
    <div class="mt-8 text-left">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Descrição da ação</h2>
        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
            {!! nl2br(e($acao->descricao)) !!}
        </p>
    </div>

    {{-- Informações para o doador --}}
    <div class="mt-8 text-left">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Informações para o doador</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li><strong>Campanha:</strong> {{ $acao->campanha->titulo ?? 'Nenhuma' }}</li>
            <li><strong>Data da ação:</strong> {{ \Carbon\Carbon::parse($acao->data_criacao)->format('d/m/Y') }}</li>
        </ul>
    </div>

    {{-- Área de doação fixada no fim --}}
    <div class="mt-10" id="doar">
        <a href="#"
           class="inline-block bg-green-600 hover:bg-green-700 text-white text-xl font-bold px-10 py-4 rounded-full shadow-lg transition">
           Doar agora
        </a>
        <p class="text-sm text-gray-500 mt-2">Sua contribuição faz a diferença 🌱</p>
    </div>

</div>
@endsection
