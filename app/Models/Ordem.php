<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordem extends Model
{
    use HasFactory;

    protected $table = 'ordens';

    protected $fillable = [
        'numordem',
        'cliente_id',
        'defeito',
        'equipamento',
        'modelo',
        'senha',
        'estado',
        'acessorios',
        'orcamento',
        'descorcamento',
        'detalhes',
        'pecas',
        'valpecas',
        'valservico',
        'custo',
        'previsao',
        'status',
        'envioemail',
        'dtentrega',
        'tecnico',
        'observacoes'
    ];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
