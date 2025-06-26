<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Acoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data_criacao',
        'caminho_imagem',
        'valor_alcancado',
        'chavepix',
        'user_id',
        'campanha_id',
    ];

    public function campanha()
    {
        return $this->belongsTo(Campanhas::class, 'campanha_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}