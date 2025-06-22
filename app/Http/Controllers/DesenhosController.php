<?php

namespace App\Http\Controllers;

use App\Models\Desenho;
use App\Models\Desafio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesenhoController extends Controller
{
    public function index()
    {
        $desenhos = Desenho::with('user', 'desafio')->get();
        return view('desenhos.index', compact('desenhos'));
    }

    public function create()
    {
        $desafios = Desafio::all();
        return view('desenhos.create', compact('desafios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'data_criacao' => 'required|date',
            'caminho_imagem' => 'required|image',
        ]);

        $path = $request->file('caminho_imagem')->store('desenhos', 'public');

        Desenho::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_criacao' => $request->data_criacao,
            'caminho_imagem' => $path,
            'user_id' => Auth::id(),
            'desafios_id' => $request->desafios_id,
        ]);

        return redirect()->route('desenhos.index');
    }

    public function edit(Desenho $desenho)
    {
        $this->authorize('update', $desenho);
        $desafios = Desafio::all();
        return view('desenhos.edit', compact('desenho', 'desafios'));
    }

    public function update(Request $request, Desenho $desenho)
    {
        $this->authorize('update', $desenho);

        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'data_criacao' => 'required|date',
        ]);

        if ($request->hasFile('caminho_imagem')) {
            $path = $request->file('caminho_imagem')->store('desenhos', 'public');
            $desenho->caminho_imagem = $path;
        }

        $desenho->update($request->only('titulo', 'descricao', 'data_criacao', 'desafios_id'));

        return redirect()->route('desenhos.index');
    }

    public function destroy(Desenho $desenho)
    {
        $this->authorize('delete', $desenho);
        $desenho->delete();
        return redirect()->route('desenhos.index');
    }
}
