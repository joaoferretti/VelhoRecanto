<?php

namespace App\Http\Controllers;

use App\Models\Desenhos;
use App\Models\Desafios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DesenhosController extends Controller
{

    use AuthorizesRequests; 

    public function index(Request $request)
    {
        $query = Desenhos::with('user', 'desafio');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%$search%")
                ->orWhere('descricao', 'like', "%$search%");
            });
        }

        if ($request->filled('desafio_id')) {
            $query->where('desafios_id', $request->input('desafio_id'));
        }

        if ($request->boolean('meus')) {
            $query->where('user_id', auth()->id());
        }

        $sortBy = $request->input('sort_by', 'data_criacao');
        $direction = $request->input('direction', 'desc');

        $desenhos = $query->orderBy($sortBy, $direction)->get();
        $desafios = Desafios::all();

        return view('desenhos.index', compact('desenhos', 'desafios'));
    }

    public function create()
    {
        $desafios = Desafios::all();
        return view('desenhos.create', compact('desafios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_criacao' => 'required|date',
            'caminho_imagem' => 'required|max:2048',
            'desafios_id' => 'nullable|exists:desafios,id',
        ]);

        $path = $request->file('caminho_imagem')->store('desenhos', 'public');

        Desenhos::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_criacao' => $request->data_criacao,
            'caminho_imagem' => $path,
            'user_id' => Auth::id(),
            'desafios_id' => $request->desafios_id,
        ]);

        return redirect()->route('desenhos.index');
    }

    public function edit(Desenhos $desenho)
    {
        $this->authorize('update', $desenho);
        $desafios = Desafios::all();
        return view('desenhos.edit', compact('desenho', 'desafios'));
    }

    public function update(Request $request, Desenhos $desenho)
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

        $desenho->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_criacao' => $request->data_criacao,
            'desafios_id' => $request->desafios_id,
        ]);
        return redirect()->route('desenhos.index');
    }

    public function destroy(Desenhos $desenho)
    {
        $this->authorize('delete', $desenho);
        $desenho->delete();
        return redirect()->route('desenhos.index');
    }
}
