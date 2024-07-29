<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'gestor_id',
        'contratada'
    ];

    public function gestor()
    {
        return $this->belongsTo(User::class);
    }

    public function vigencias()
    {
        return $this->hasMany(Vigencia::class)->orderBy('data_fim', 'desc');
    }

    public function ultimaVigencia()
    {
        return $this->vigencias()->orderBy('data_fim', 'desc')->first();
    }
}
