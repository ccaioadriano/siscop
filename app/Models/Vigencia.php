<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vigencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'contrato_id',
        'data_inicio',
        'data_fim',
        'valor_ponto_funcao',
        'valor_hora',
    ];
}
