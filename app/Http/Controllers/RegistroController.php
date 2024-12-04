<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use App\Models\UsuarioModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class RegistroController extends Controller
{
    public function show()
    {
        return view('registro');
    }

    // usei a api do site https://www.abstractapi.com/api/email-verification-validation-api
    protected function testarEmail(RegistroRequest $request)
    {
        $email = $request->input('email');
        
        $apiKey = 'f79972152e6c4a8ea5c809261b2d71d5';

        $response = Http::get('https://emailvalidation.abstractapi.com/v1/', [
            'api_key' => $apiKey,
            'email' => $email,
        ])->json();

        return $response;
    }

    public function create(RegistroRequest $request)
    {
        // Valida o e-mail antes de continuar
        $emailResponse = $this->testarEmail($request);

        if ($emailResponse['deliverability'] == "UNDELIVERABLE") {
            return redirect()->back()->withErrors(['email' => 'O e-mail fornecido é inválido.']);
        }else{
            // Criação do usuário
            UsuarioModel::create([
            'nome' => $request->nome,
            'sobrenome' => $request->sobrenome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            ]);

            return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso.');
        }
    }
}