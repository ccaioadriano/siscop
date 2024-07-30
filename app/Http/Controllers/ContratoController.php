<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVigenciaRequest;
use App\Models\Contrato;
use App\Models\User;
use App\Models\Vigencia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index(Request $request)
    {
        $contratos = Contrato::all();

        return view('contrato.index', compact('contratos'));
    }

    public function show(int $id)
    {
        $contrato = Contrato::find($id);
        return view('contrato.show', compact('contrato'));
    }

    public function create()
    {
        $gestores = User::all();
        return view('contrato.create', compact('gestores'));
    }

    public function store(Request $request)
    {
        $contrato = new Contrato();
        $contrato->gestor_id = $request->gestor_id;
        $contrato->contratada = $request->contratada;
        $contrato->save();
        $contrato->vigencias()->create([
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'valor_ponto_funcao' => $this->clearNumbers($request->valor_ponto_funcao),
            'valor_hora' => $this->clearNumbers($request->valor_hora),
        ])->save();

        return redirect(route("contrato.index"))->with('success', 'Contrato incluido com sucesso.');
    }

    public function edit(int $id)
    {
        $contrato = Contrato::find($id);
        $gestores = User::all();
        return view("contrato.edit", compact('contrato', 'gestores'));
    }

    public function update(Request $request, int $id)
    {
        // Validação dos dados enviados
        // $request->validate([
        //     'gestor_id' => 'required|exists:gestores,id',
        //     'data_inicio' => 'required|date',
        //     'data_fim' => 'required|date|after_or_equal:data_inicio',
        //     'valor_ponto_funcao' => 'required|numeric|min:0',
        //     'valor_hora' => 'required|numeric|min:0',
        //     'contratada' => 'required|string|max:255',
        // ]);

        // Encontrar o contrato pelo ID
        $contrato = Contrato::findOrFail($id);


        $contrato->ultimaVigencia()->update([
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'valor_ponto_funcao' => $request->valor_ponto_funcao,
            'valor_hora' => $request->valor_hora,
        ]);

        $contrato->update([
            'gestor_id' => $request->gestor_id,
            'contratada' => $request->contratada,
        ]);

        return redirect(route("contrato.show", $id))->with('success', 'Contrato alterado com sucesso.');
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
    public function createVigencia(int $contrato_id)
    {

        $contrato = Contrato::find($contrato_id);

        return view('contrato.vigencia.create', compact('contrato'));
    }

    public function storeVigencia(StoreVigenciaRequest $request)
    {
        $vigencia = new Vigencia();
        $vigencia->fill($request->except(['valor_ponto_funcao', 'valor_hora']));
        $vigencia->valor_ponto_funcao = $request->valor_ponto_funcao;
        $vigencia->valor_hora = $request->valor_hora;
        $vigencia->save();

        return redirect(route("contrato.show", $request->contrato_id))->with('success', 'Vigencia incluida com sucesso.');
    }
}
