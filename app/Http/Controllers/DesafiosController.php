<?php

namespace App\Http\Controllers;

use App\Models\Desafio;
use Illuminate\Http\Request;

class DesafioController extends Controller
{
    public function index()
    {
        $desafios = Desafio::latest()->paginate(10);
        return view('desafios.index', compact('desafios'));
    }

    public function create()
    {
        return view('desafios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_desafio' => 'required',
            'descricao_desafio' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'cor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        Desafio::create($request->all());

        return redirect()->route('desafios.index');
    }

    public function edit(Desafio $desafio)
    {
        return view('desafios.edit', compact('desafio'));
    }

    public function update(Request $request, Desafio $desafio)
    {
        $request->validate([
            'nome_desafio' => 'required',
            'descricao_desafio' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'cor' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $desafio->update($request->all());

        return redirect()->route('desafios.index');
    }

    public function destroy(Desafio $desafio)
    {
        $desafio->delete();
        return redirect()->route('desafios.index');
    }
}