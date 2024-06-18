<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function getValores(Request $request)
    {

        $request->validate([
            'contrato_id' => 'required'
        ],
        [
            'contrato_id.required' => 'O número do contrato não pode ser vazio.'
        ]
    );

        try {
            $contrato = Contrato::find($request->contrato_id);


            return response()->json([
                'valorPF' => $contrato->valor_ponto_funcao,
                'valorHR' => $contrato->valor_hora,
            ]);
        } catch (\Exception $exception) {
            return response()->json(['erro' => $exception->getMessage()], 500);
        }
    }
}
