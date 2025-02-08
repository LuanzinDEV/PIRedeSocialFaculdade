<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembroModel extends Model
{
    use HasFactory;

    protected $table = 'membros_projetos';

    protected $fillable = [
        'projeto_id',
        'usuario_id',
        'data_entrada',
    ];

    protected $dates = [
        'data_entrada',
    ];

    /**
     * Relacionamento com o modelo Projeto.
     */
    public function projeto()
    {
        return $this->belongsTo(ProjetoModel::class, 'projeto_id');
    }

    /**
     * Relacionamento com o modelo Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(UsuarioModel::class, 'usuario_id');
    }
}

