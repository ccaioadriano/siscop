<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;


    protected $table = "ordens_servicos";

    protected $fillable = [
        'contrato_id',
        'sei',
        'sistema_id',
        'qtd_realizada',
        'qtd_estimada',
        'metrica_id',
        'nota_id',
        'descricao',
        'valor_total'
    ];

    public function metrica()
    {
        return $this->belongsTo(Metrica::class);
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function nota_fiscal()
    {
        return $this->belongsTo(NotaFiscal::class, 'nota_id');
    }

    public function sistema()
    {
        return $this->belongsTo(Sistema::class);
    }
}
