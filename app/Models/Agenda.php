<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = "agendas";

    protected $fillable = [
        'cliente_id',
        'datahora',
        'servico',
        'detalhes',
        'tecnico',
        'status',
        'observacoes'
    ];
}
