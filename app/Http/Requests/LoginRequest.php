<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define as regras de validação para a requisição.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|exists:usuarios,email',
            'senha' => 'required|string|min:8',
        ];
    }

    /**
     * Define mensagens de erro personalizadas.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.exists' => 'O e-mail informado não está cadastrado.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ];
    }
}
