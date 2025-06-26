<?php

namespace App\Http\Controllers;

use App\Models\Campanhas;
use Illuminate\Http\Request;

class CampanhasController extends Controller
{
    public function index()
    {
        $campanhas = Campanhas::all();
        return view('campanhas.index', compact('campanhas'));
    }

    public function create()
    {
        return view('campanhas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string', 
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'tipo_objetivo' => 'required|string|in:monetario,alcance,doacoes,voluntarios',
            'objetivo' => 'required|numeric|min:0',
            'cor' => 'required|string|max:7',
        ]);

        if(isset($request->objetivo)) {
            $request->objetivo = '0';
        }    

        Campanhas::create($request->all());

        return redirect()->route('campanhas.index')->with('success', 'Campanha criada com sucesso.');
    }

    public function edit(Campanhas $campanha)
    {
        return view('campanhas.edit', compact('campanha'));
    }

    public function update(Request $request, Campanhas $campanha)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string', 
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'tipo_objetivo' => 'required|string|in:monetario,alcance,doacoes,voluntarios',
            'objetivo' => 'numeric|min:0',
            'cor' => 'required|string|max:7',
        ]);

    $campanha->update($request->all());

        return redirect()->route('campanhas.index')->with('success', 'Campanha atualizada com sucesso.');
    }

    public function destroy(Campanhas $campanha)
    {
        $campanha->delete();
        return redirect()->route('campanhas.index')->with('success', 'Campanha excluída com sucesso.');
    }

        public function show(Campanhas $campanha)
    {
        $campanha->load('acoes');
        return view('campanhas.show', compact('campanha'));
    }

}