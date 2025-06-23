<?php

namespace App\Http\Controllers;

use App\Models\Desafios;
use Illuminate\Http\Request;

class DesafiosController extends Controller
{
    public function index()
    {
        $desafios = Desafios::all();
        return view('desafios.index', compact('desafios'));
    }

    public function create()
    {
        return view('desafios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_desafio' => 'required|string|max:255',
            'descricao_desafio' => 'required|string', 
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'cor' => 'required|string|max:7',
        ]);

        // O método create() aceita um array de atributos
        Desafios::create($request->all());

        return redirect()->route('desafios.index')->with('success', 'Desafio criado com sucesso.');
    }

    public function edit(Desafios $desafio)
    {
        return view('desafios.edit', compact('desafio'));
    }

    public function update(Request $request, Desafios $desafio)
    {
        $request->validate([
            'nome_desafio' => 'required|string|max:255',
            'descricao_desafio' => 'required|string', 
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'cor' => 'required|string|max:7',
        ]);

        $desafio->update($request->all());

        return redirect()->route('desafios.index')->with('success', 'Desafio atualizado com sucesso.');
    }

    public function destroy(Desafios $desafio)
    {
        $desafio->delete();
        return redirect()->route('desafios.index')->with('success', 'Desafio excluído com sucesso.');
    }
}
