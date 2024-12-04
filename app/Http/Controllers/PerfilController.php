<?php

namespace App\Http\Controllers;

use App\Models\MusicaModel;
use App\Models\UsuarioModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Exibe o perfil do usuário autenticado e suas músicas.
     */
    public function index()
    {
        $musicas = MusicaModel::where('artista_id', auth()->id())->get();
        $perfil = auth()->user(); // Obtém o usuário autenticado diretamente

        return view('perfil', compact('musicas', 'perfil'));
    }

    public function imgPerfilHeader()
    {
        $perfil = auth()->user();
        return view('header', compact('perfil'));
    }

    public function viewEditar()
    {
        $perfil = auth()->user();
        return view('editarPerfil', compact('perfil'));
    }

    public function atualizar(Request $request)
    {
        // Validação dos campos
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:255',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // validação da foto
        ]);

        // Buscar o usuário atual (supondo que você tenha o método para pegar o usuário logado)
        $user = auth()->user();

        // Atualizar informações básicas
        $user->nome = $request->input('nome');
        $user->sobrenome = $request->input('sobrenome');
        $user->descricao = $request->input('descricao');
        

        // Verificar se foi enviado um arquivo de foto de perfil
        if ($request->hasFile('foto_perfil')) {
            // Deletar a foto anterior, se houver
            if ($user->foto_perfil && Storage::exists('public/perfil/' . $user->foto_perfil)) {
                Storage::delete('public/perfil/' . $user->foto_perfil);
            }

            // Salvar a nova foto de perfil
            $fotoPerfil = $request->file('foto_perfil')->store('perfil', 'public');
            
            // Armazenar o nome do arquivo no banco de dados
            $user->foto_perfil = basename($fotoPerfil); // Salva o nome do arquivo no banco
        }

        // Salvar as alterações no banco
        $user->save();

        // Retornar uma resposta ou redirecionar
        return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function pesquisarAjax(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            return response()->json(['erro' => 'Consulta vazia'], 400);
        }

        $usuarios = UsuarioModel::where('nome', 'LIKE', '%' . $query . '%')->get();

        return view('partials.resultados', compact('usuarios'))->render();
    }

    public function show($id)
    {
        // Busca o usuário pelo ID
        $perfil = UsuarioModel::findOrFail($id);

        // Busca músicas associadas ao usuário (se houver)
        $musicas = MusicaModel::where('id', $id)->get();

        // Retorna a view com os dados do perfil e músicas
        return view('perfilBusca', compact('perfil', 'musicas'));
    }


}
