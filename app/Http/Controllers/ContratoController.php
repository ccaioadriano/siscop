<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function getValores(Request $request)
    {
        try {
            $contrato = Contrato::find($request->contrato_id);

            if(!$contrato) {
                throw new \Exception("Número de contrato nulo.");
            }

            return response()->json([
                'valorPF' => $contrato->valor_ponto_funcao,
                'valorHR' => $contrato->valor_hora,
            ]);
        } catch (\Exception $exception) {
            return response()->json(['erro' => $exception->getMessage()], 500);
        }
    }
}
