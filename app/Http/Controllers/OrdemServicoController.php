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

    public function calcularMetrica(Request $request)
    {

        $request->validate(
            [
                'metrica_id' => 'required',
                'contrato_id' => 'required',
                'qtd_realizada' => 'required|numeric',
            ],
            [

                'contrato_id.required' => 'O número do contrato não pode ser vazio.',
                'metrica_id.required' => 'O Campo métrica é obrigatório.',
                'qtd_realizada.required'=> 'O campo qtd realizada é obrigatório.',
                'qtd_realizada.numeric'=> 'O campo qtd realizada precisa ser um número.',
            ]   
        );

        try {
            $contrato = Contrato::find($request->contrato_id);
            $metrica = Metrica::find($request->metrica_id);
            $qtd_realizada = $request->qtd_realizada;
            $valor_total = 0;

            switch ($metrica->tipo) {
                case 'PF':

                    $valor_total = $contrato->valor_ponto_funcao * $qtd_realizada;
                    break;
                case 'HR':

                    $valor_total = $contrato->valor_hora * $qtd_realizada;
                    break;
            }

            if (($contrato == null) || ($contrato->id == 0)) {
                throw new \Exception("Número de contrato nulo e deve ser diferente de 0.");
            }

            return response()->json([
                'valor_total' => $valor_total,
            ]);
            
        } catch (\Exception $exception) {
            return response()->json(['erro' => $exception->getMessage()], 500);
        }
    }

    //edit
}
