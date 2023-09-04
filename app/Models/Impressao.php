<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impressao extends Model
{
    use HasFactory;

    protected $table = 'impressoes';

    protected $fillable = [
        'entrada',
        'saida'
    ];
}
