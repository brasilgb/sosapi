<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'cpf',
        'nome',
        'email',
        'cep',
        'uf',
        'cidade',
        'bairro',
        'endereco',
        'complemento',
        'telefone',
        'contato',
        'telcontato',
        'obs',
    ];
}
