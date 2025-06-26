<?php

namespace App\Http\Controllers;

use App\Models\Acoes;
use App\Models\Campanhas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AcoesController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Acoes::with('campanha');

        if ($request->filled('search')) {
            $query->where('titulo', 'like', "%{$request->search}%")
                ->orWhere('descricao', 'like', "%{$request->search}%");
        }

        if ($request->filled('campanha_id')) {
            $query->where('campanha_id', $request->campanha_id);
        }

        if ($request->filled('meus') && auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        if ($request->filled('sort_by')) {
            $sortColumn = $request->sort_by;
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy($sortColumn, $direction);
        }

        $acoes = $query->get();
        $campanhas = Campanhas::all();

        return view('acoes.index', compact('acoes', 'campanhas'));
    }

    public function create()
    {
        $campanhas = Campanhas::all();
        return view('acoes.create', compact('campanhas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_criacao' => 'required|date',
            'caminho_imagem' => 'required|image|max:2048',
            'valor_alcancado' => 'required|numeric|min:0',
            'chavepix' => 'required|string',
            'campanha_id' => 'nullable|exists:campanhas,id',
        ]);

        $path = $request->file('caminho_imagem')->store('acoes', 'public');

        Acoes::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_criacao' => $request->data_criacao,
            'caminho_imagem' => $path,
            'valor_alcancado' => $request->valor_alcancado,
            'chavepix' => $request->chavepix,
            'user_id' => Auth::id(),
            'campanha_id' => $request->campanha_id,
        ]);

        return redirect()->route('acoes.index')->with('success', 'Ação criada com sucesso.');
    }

    public function edit(Acoes $acao)
    {
        $this->authorize('update', $acao);
        $campanhas = Campanhas::all();
        return view('acoes.edit', compact('acao', 'campanhas'));
    }

    public function update(Request $request, Acoes $acao)
    {
        $this->authorize('update', $acao);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_criacao' => 'required|date',
            'valor_alcancado' => 'nullable|numeric|min:0',
            'chavepix' => 'required|string',
            'campanha_id' => 'nullable|exists:campanhas,id',
        ]);

        if ($request->hasFile('caminho_imagem')) {
            $path = $request->file('caminho_imagem')->store('acoes', 'public');
            $acao->caminho_imagem = $path;
        }

        $acao->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_criacao' => $request->data_criacao,
            'valor_alcancado' => $request->valor_alcancado ?: '0',
            'chavepix' => $request->chavepix,
            'campanha_id' => $request->campanha_id,
        ]);

        return redirect()->route('acoes.index')->with('success', 'Ação atualizada com sucesso.');
    }

    public function destroy(Acoes $acao)
    {
        $this->authorize('delete', $acao);
        $acao->delete();
        return redirect()->route('acoes.index')->with('success', 'Ação excluída com sucesso.');
    }

    public function show(Acoes $acao)
    {
        $acao->load('campanha.acoes');

        $meta = $acao->campanha->objetivo ?? 1;
        $arrecadado = $acao->campanha ? $acao->campanha->acoes->sum('valor_alcancado') : 0;
        $porcentagem = min(100, round(($arrecadado / $meta) * 100, 2));

        return view('acoes.show', compact('acao', 'meta', 'arrecadado', 'porcentagem'));
    }


}