<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordem extends Model
{
    use HasFactory;

    protected $table = 'ordens';

    protected $fillable = [
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
        'valpecas',
        'valservico',
        'custo',
        'previsao',
        'statusorcamento',
        'concluido',
        'status',
        'comunicado',
        'entrega',
        'dt_entrega',
        'tecnico',
        'observacoes'
    ];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
