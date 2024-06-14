<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = "ordens_servicos";

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
        return $this->belongsTo(NotaFiscal::class);
    }
}
