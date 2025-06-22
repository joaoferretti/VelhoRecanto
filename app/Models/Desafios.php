<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desafio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_desafio',
        'descricao_desafio',
        'data_inicio',
        'data_fim',
        'cor',
    ];

    public function desenhos()
    {
        return $this->hasMany(Desenho::class);
    }
}
