<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenho extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data_criacao',
        'caminho_imagem',
        'user_id',
        'desafio_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function desafio()
    {
        return $this->belongsTo(Desafio::class);
    }
}
