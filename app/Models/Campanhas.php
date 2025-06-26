<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campanhas extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data_inicio',
        'data_fim',
        'tipo_objetivo',
        'objetivo',
        'cor',
    ];

    public function acoes()
    {
        return $this->hasMany(Acoes::class, 'campanha_id');
    }
}
