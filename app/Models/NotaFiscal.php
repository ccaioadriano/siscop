<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasFactory;
    protected $table = "notas_fiscais";

    protected $fillable = [
        'contrato_id',
        'data_emissao',
        'valor_total'
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function ordensServico()
    {
        return $this->hasMany(OrdemServico::class, 'nota_id');
    }
}
