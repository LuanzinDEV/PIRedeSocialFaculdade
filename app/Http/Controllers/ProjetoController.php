<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjetoModel;
use App\Models\UsuarioModel;
use App\Http\Controllers\FeedController;

class ProjetoController extends Controller
{
    /**
     * Exibir a lista de projetos.
     */
    public function index()
    {
        $projetos = ProjetoModel::with('membros')->get();
        $usuarioId = auth()->id();

        return view('conexoes', compact('projetos', 'usuarioId'));
    }

    /**
     * Conectar-se a um projeto (adicionar como membro).
     */
    public function conectar(Request $request, $id)
    {
        $usuarioId = auth()->id(); // Pega o ID do usuário logado
        $projeto = ProjetoModel::findOrFail($id);

        // Verifica se o usuário já é membro
        if ($projeto->membros->contains('id', $usuarioId)) {
            return redirect()->route('projetos.index')->with('error', 'Você já pertence a este projeto!');
        }

        // Lógica para adicionar o usuário ao projeto
        $projeto->membros()->attach($usuarioId);

        // Cria o feed para o usuário que se conectou ao projeto
        $feedController = new FeedController();
        $feedController->store($request, 'conectou ao projeto "' . $projeto->nome . '"');

        return redirect()->route('projetos.index')->with('success', 'Você se conectou ao projeto com sucesso!');
    }

    /**
     * Criar um novo projeto.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
        ]);

        // Cria o projeto
        $projeto = ProjetoModel::create($validated);

        // Cria o feed para o usuário que criou o projeto
        $feedController = new FeedController();
        $feedController->store($request, 'criou o projeto "' . $projeto->nome . '"');

        return redirect()->route('projetos.index')->with('success', 'Projeto criado com sucesso!');
    }
}

