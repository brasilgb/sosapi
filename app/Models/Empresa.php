<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = "empresa";

    protected $fillable = [
        'empresa',
        'razao',
        'cnpj',
        'logo',
        'endereco',
        'bairro',
        'uf',
        'cidade',
        'cep',
        'telefone',
        'site',
        'email'
    ];
}
