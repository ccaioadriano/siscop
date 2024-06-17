<?php

namespace App\Http\Controllers;

use App\Models\Metrica;
use App\Models\OrdemServico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::all();
        return view("ordemServico.index", compact("ordens"));
    }

    public function create()
    {
        $metricas = Metrica::all();
        return view("ordemServico.create", compact("metricas"));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'contrato_id' => 'required|max:10',
                'sei' => 'required|max:23',
                'sistema' => 'required',
                'qtd_realizada' => 'nullable|required|numeric',
                'metrica_id' => 'required',
                'nota_id' => 'nullable|numeric',
            ],
        );

        $ordemServico = new OrdemServico();
        $ordemServico->fill($request->all());
        $ordemServico->save();
        return redirect(route("ordemServico.index"));
    }
}
