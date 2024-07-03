<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use NumberFormatter;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function clearNumbers($number)
    {
        return (float) str_replace(['R$', '.', ','], ['', '', '.'], $number);
    }

    function formatCurrency($amount, $currencySymbol = 'R$', $decimalSeparator = ',', $thousandSeparator = '.')
    {
        return $currencySymbol . ' ' . number_format($amount, 2, $decimalSeparator, $thousandSeparator);
    }

    public function atualizaValorNota(NotaFiscal $notaFiscal)
    {
        $notaFiscal->valor_total = $notaFiscal->ordensServico()->sum('valor_total');
        $notaFiscal->save();
    }
}
