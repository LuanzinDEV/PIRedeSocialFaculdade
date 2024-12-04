<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicaModel;
use App\Models\AtividadeModel;
use App\Http\Controllers\FeedController;

class MusicaController extends Controller
{
    /**
     * Exibe o formulário de postagem de músicas.
     */
    public function create()
    {
        $atividades = AtividadeModel::orderBy('created_at', 'desc')->take(10)->get();
        return view('home', compact('atividades'));
    }

    /**
     * Processa o envio da música e salva no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'genero' => 'required|string|max:100',
            'arquivo' => 'required|mimes:mp3|max:10240', // Máximo de 10 MB
        ]);

        // Armazenando a música
        $caminho = $request->file('arquivo')->store('musicas', 'public');

        // Criando a música no banco de dados
        MusicaModel::create([
            'titulo' => $request->titulo,
            'genero' => $request->genero,
            'data_upload' => now(),
            'artista_id' => auth()->id(),
            'arquivo' => $caminho,
        ]);


        $feedController = new FeedController();
        $feedController->store($request, 'salvou a música');

        // Passando o caminho para a view de redirecionamento
        return redirect()->route('musicas.create')
                        ->with('success', 'Música enviada com sucesso!')
                        ->with('caminho', $caminho); // Passando o caminho da música
    }

    public function index()
    {
        // Obtém todas as músicas do artista logado
        $musicas = MusicaModel::where('artista_id', auth()->id())->get();

        // Retorna a view com as músicas
        return view('minhasMusicas', compact('musicas'));
    }
}

