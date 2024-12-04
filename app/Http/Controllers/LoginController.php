<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\UsuarioModel;
use App\Models\AtividadeModel;

class LoginController extends Controller
{
    public function __construct()
    {
        // Protege a rota "retornaHome", por exemplo, apenas para usuários autenticados
        $this->middleware('auth')->only('retornaHome');
    }

    /**
     * Exibe a página de login.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Valida as credenciais do usuário e autentica-o.
     */
    public function validaLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'senha');

        $usuario = UsuarioModel::where('email', $credentials['email'])->first();

        if ($usuario && $usuario->verificarSenha($credentials['senha'])) {
            Auth::login($usuario);
            return redirect()->route('home');
        }

        return redirect()
            ->route('login')
            ->withErrors(['email' => 'Credenciais inválidas.']);
    }

    /**
     * Exibe a página inicial do usuário autenticado.
     */
    public function retornaHome()
    {
        $atividades = AtividadeModel::orderBy('created_at', 'desc')->take(10)->get();
        return view('home', compact('atividades'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
