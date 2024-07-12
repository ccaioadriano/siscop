<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVigenciaRequest;
use App\Models\Contrato;
use App\Models\Vigencia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index(Request $request)
    {
        $query = Contrato::whereHas('vigencias');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', "%{$search}%");
        }

        $contratos = $query->with(['vigencias'])->paginate(10);

        return view('contrato.index', compact('contratos'));
    }

    public function show(int $id)
    {
        $contrato = Contrato::find($id);
        return view('contrato.show', compact('contrato'));
    }

    public function getValores(Request $request)
    {
        $request->validate(
            [
                'contrato_id' => 'required'
            ],
            [
                'contrato_id.required' => 'O número do contrato não pode ser vazio.',
                'contrato_id.exists' => 'O contrato não existe.'
            ]
        );

        try {
            $contrato = Contrato::find($request->contrato_id);

            $vigencia_contrato = $contrato->vigencias()
                ->where('data_inicio', '<=', Carbon::now())
                ->where('data_fim', '>=', Carbon::now())
                ->first();

            return response()->json([
                'valorPF' => $this->formatCurrency($vigencia_contrato->valor_ponto_funcao),
                'valorHR' => $this->formatCurrency($vigencia_contrato->valor_hora),
            ]);
        } catch (\Exception $exception) {
            return response()->json(['erro' => $exception->getMessage()], 500);
        }
    }

    //criar vigencia
    public function createVigencia(int $contrato_id)
    {

        $contrato = Contrato::find($contrato_id);

        return view('contrato.vigencia.create', compact('contrato'));
    }

    public function storeVigencia(StoreVigenciaRequest $request)
    {
        $vigencia = new Vigencia();
        $vigencia->fill($request->except(['valor_ponto_funcao', 'valor_hora']));
        $vigencia->valor_ponto_funcao = $this->clearNumbers($request->valor_ponto_funcao);
        $vigencia->valor_hora = $this->clearNumbers($request->valor_hora);
        //dd($vigencia);
        $vigencia->save();

        return redirect(route("contrato.show", $request->contrato_id))->with('success', 'Vigencia incluida com sucesso.');
    }
}
