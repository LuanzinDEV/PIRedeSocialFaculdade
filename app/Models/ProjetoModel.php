<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjetoModel extends Model
{
    use HasFactory;

    protected $table = 'projetos_musicais'; // Define a tabela associada ao modelo

    protected $fillable = [
        'nome',
        'descricao',
        'data_criacao',
    ];

    /**
     * Relacionamento com o modelo Membro.
     */
    public function membros()
    {
        return $this->belongsToMany(UsuarioModel::class, 'membros_projetos', 'projeto_id', 'usuario_id');
    }
}
