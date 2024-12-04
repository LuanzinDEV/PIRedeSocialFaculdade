<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicaModel extends Model
{
    use HasFactory;

    protected $table = 'musicas'; // Define a tabela associada ao modelo

    protected $fillable = [
        'titulo',
        'genero',
        'data_upload',
        'artista_id',
        'arquivo',
    ];

    /**
     * Relacionamento com o modelo de Usuário.
     * Um música pertence a um artista (usuário).
     */
    public function artista()
    {
        return $this->belongsTo(UsuarioModel::class, 'artista_id');
    }

    protected $dates = ['data_upload'];
}
