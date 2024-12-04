<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:45',
            'senha' => 'required|string|min:8|max:45|confirmed',
            'email' => 'required|string|email|max:140|unique:usuarios,email',
            'sobrenome' => 'required|string|max:120',
        ];
    }

    /**
     * Get the custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'sobrenome.required' => 'O campo sobrenome é obrigatório.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.confirmed' => 'A confirmação da senha não coincide.',
            'senha.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está registrado.',
        ];
    }
}