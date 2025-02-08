<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AtividadeModel extends Model
{
    protected $table = 'feed_atividades';  
    protected $fillable = ['usuario_id', 'descricao'];

    // Relacionamento com o usuário
    public function usuario()
    {
        return $this->belongsTo(UsuarioModel::class, 'usuario_id');  // Relacionamento com o modelo UsuarioModel
    }
}

