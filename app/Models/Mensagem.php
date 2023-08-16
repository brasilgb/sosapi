<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use HasFactory;

    protected $table = "mensagens";

    protected $fillable = [
        'usuario_id',
        'remetente',
        'destinatario',
        'mensagem',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
