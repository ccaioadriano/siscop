<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Metrica;
use App\Models\OrdemServico;
use App\Models\Sistema;
use Carbon\Carbon;
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
        $sistemas = Sistema::all();

        //retorna somente os contratos vigentes
        $contratos_vigentes = Contrato::where('data_inicio', '<=', Carbon::now())
            ->where('data_fim', '>=', Carbon::now())
            ->get();

        return view("ordemServico.create", compact("metricas", "sistemas", "contratos_vigentes"));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'contrato_id' => 'required',
                'sei' => 'required|max:23',
                'sistema_id' => 'required',
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
