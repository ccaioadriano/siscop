<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Metrica;
use App\Models\NotaFiscal;
use App\Models\OrdemServico;
use App\Models\Sistema;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index(Request $request)
    {
        $query = OrdemServico::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('contrato_id', 'LIKE', "%{$search}%")
                ->orWhereHas('sistema', function ($q) use ($search) {
                    $q->where('nome', 'LIKE', "%{$search}%");
                });
        }

        $ordens = $query->paginate(10);
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

    public function show(int $id)
    {
        $ordem = OrdemServico::find($id);
        return view("ordemServico.show", compact('ordem'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'contrato_id' => 'required',
                'sei' => 'required',
                'sistema_id' => 'required',
                'qtd_estimada' => 'required',
                'metrica_id' => 'required',
            ],
        );

        $ordemServico = new OrdemServico();
        $ordemServico->fill($request->except('valor_total'));
        $ordemServico->valor_total = $this->clearNumbers($request->valor_total);
        $ordemServico->save();
        return redirect(route("ordemServico.index"));
    }

    public function edit(int $id)
    {
        $ordem = OrdemServico::find($id);
        $ordem->valor_total = number_format($ordem->valor_total, 2, ',', '.');
        $metricas = Metrica::all();
        $contratos_vigentes = Contrato::where('data_inicio', '<=', Carbon::now())
            ->where('data_fim', '>=', Carbon::now())
            ->get();
        $sistemas = Sistema::all();
        $notas_fiscais = NotaFiscal::all();
        return view("ordemServico.edit", compact('ordem', 'metricas', 'contratos_vigentes', 'sistemas', 'notas_fiscais'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'contrato_id' => 'required|exists:contratos,id',
            'sei' => 'required',
            'sistema_id' => 'required',
            'qtd_estimada' => 'required',
            'qtd_realizada' => 'required',
            'nota_id' => 'nullable',
            'valor_total' => 'required',
            'descricao' => 'nullable',
        ]);

        $ordemServico = OrdemServico::find($id);
        $ordemServico->contrato_id = $request->input('contrato_id');
        $ordemServico->sei = $request->input('sei');
        $ordemServico->sistema_id = $request->input('sistema_id');
        $ordemServico->qtd_estimada = $request->input('qtd_estimada');
        $ordemServico->qtd_realizada = $request->input('qtd_realizada');
        $ordemServico->nota_id = $request->input('nota_id');
        $ordemServico->valor_total = $this->clearNumbers($request->input('valor_total'));
        $ordemServico->descricao = $request->input('descricao');
        $ordemServico->save();

        return redirect()->route('ordemServico.show', $id)->with('success', 'Ordem de Serviço atualizada com sucesso!');
    }


    public function calcularMetrica(Request $request)
    {

        $request->validate(
            [
                'metrica_id' => 'required',
                'contrato_id' => 'required',
                'qtd_estimada' => 'required',
            ],
            [

                'contrato_id.required' => 'O número do contrato não pode ser vazio.',
                'metrica_id.required' => 'O Campo métrica é obrigatório.',
                'qtd_estimada.required' => 'O campo qtd estimada é obrigatório.',
            ]
        );

        try {
            $contrato = Contrato::find($request->contrato_id);
            $metrica = Metrica::find($request->metrica_id);
            $qtd_estimada = $request->qtd_estimada;
            $valor_total = 0;

            switch ($metrica->tipo) {
                case 'PF':

                    $valor_total = $contrato->valor_ponto_funcao * $qtd_estimada;
                    break;
                case 'HR':

                    $valor_total = $contrato->valor_hora * $qtd_estimada;
                    break;
            }

            if (($contrato == null) || ($contrato->id == 0)) {
                throw new \Exception("Número de contrato nulo.");
            }

            return response()->json([
                'valor_total' => $this->formatCurrency($valor_total),
            ]);
        } catch (\Exception $exception) {
            return response()->json(['erro' => $exception->getMessage()], 500);
        }
    }
}
