<?php

namespace App\Http\Controllers;

use App\Models\AtividadeModel;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Armazenar uma nova atividade no feed.
     * A descrição pode ser personalizada conforme a ação.
     */
    public function store(Request $request, $descricaoAtividade)
    {
        // Não há necessidade de validação de música, pois a descrição é genérica
        $descricao = auth()->user()->name . ' ' . $descricaoAtividade;  

        // Criar a atividade no banco de dados
        AtividadeModel::create([
            'usuario_id' => auth()->user()->id,  // ID do usuário logado
            'descricao' => $descricao,  // Descrição da atividade
        ]);
    }

    /**
     * Exibir as atividades mais recentes.
     */
    public function index()
    {
        // Obtém as 10 atividades mais recentes com o nome do usuário
        $atividades = AtividadeModel::with('usuario')  
                                   ->orderBy('created_at', 'desc')
                                   ->take(10)
                                   ->get();

        // Retorna a view com as atividades
        return view('home', compact('atividades'));
    }
}


