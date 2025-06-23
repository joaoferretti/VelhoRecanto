<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenhos extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data_criacao',
        'caminho_imagem',
        'user_id',
        'desafios_id',
    ];

    protected $casts = [
        'data_criacao' => 'datetime', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function desafio()
    {
        return $this->belongsTo(Desafios::class, 'desafios_id');
    }
}
