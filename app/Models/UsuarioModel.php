<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class UsuarioModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; // Nome correto da tabela

    // Campos preenchíveis
    protected $fillable = [
        'nome',
        'senha',
        'foto_perfil',
        'descricao',
        'data_criacao',
        'email',
        'sobrenome',
    ];

    // Campos que devem ser tratados como datas
    protected $dates = [
        'data_criacao',
    ];

    // Desabilita os timestamps caso não esteja utilizando 'created_at' e 'updated_at'
    public $timestamps = true;

    /**
     * Relacionamento com o modelo Membro.
     */
    public function membros()
    {
        return $this->hasMany(MembroModel::class, 'usuario_id');
    }

    /**
     * Relacionamento com o modelo Projeto através da tabela pivot.
     */
    public function projetos()
    {
        return $this->belongsToMany(ProjetoModel::class, 'membros_projetos', 'usuario_id', 'projeto_id');
    }

    /**
     * Verifica se a senha fornecida corresponde à senha armazenada.
     */
    public function verificarSenha(string $senha): bool
    {
        return Hash::check($senha, $this->senha);
    }
}
