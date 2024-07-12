<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Metrica;
use App\Models\NotaFiscal;
use App\Models\OrdemServico;
use App\Models\Sistema;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    public function index(Request $request)
    {
        $query = NotaFiscal::query();

        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $query->where('id', 'LIKE', "%{$search}%")
        //         ->orWhere('contrato_id', 'LIKE', "%{$search}%")
        //         ->orWhereHas('sistema', function ($q) use ($search) {
        //             $q->where('nome', 'LIKE', "%{$search}%");
        //         });
        // }

        $notas = $query->paginate(10);
        return view("notaFiscal.index", compact("notas"));
    }

    public function create()
    {
        $contratos_vigentes = Contrato::whereHas('vigencias', function ($query) {
            $query->where('data_inicio', '<=', Carbon::now())
                ->where('data_fim', '>=', Carbon::now());
        })->get();
        return view("notaFiscal.create", compact("contratos_vigentes"));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'contrato_id' => 'required',
                'data_emissao' => 'required'
            ],
        );

        $nota = new NotaFiscal();
        $nota->fill($request->all());

        $nota->save();

        return redirect(route("notaFiscal.index"))->with('success', 'Nota Fiscal criada com sucesso.');
    }

    public function show(int $id)
    {
        $nota = NotaFiscal::find($id);
        return view("notaFiscal.show", compact('nota'));
    }

    public function edit(int $id)
    {
        $nota = NotaFiscal::find($id);
        $metricas = Metrica::all();
        $sistemas = Sistema::all();
        return view("notaFiscal.edit", compact('nota', 'metricas', 'sistemas'));
    }

    public function update(Request $request, int $id)
    {
        // Validação (adapte conforme necessário)
        // $request->validate([
        //     'valor_total' => 'required|numeric',
        //     'ordensServico.*.id' => 'required|integer|exists:ordens_servico,id',
        //     'ordensServico.*.sei' => 'required|string',
        //     'ordensServico.*.sistema' => 'required|string',
        //     'ordensServico.*.qtd_realizada' => 'required|string',
        //     'ordensServico.*.metrica_id' => 'required|integer|exists:metricas,id',
        //     'ordensServico.*.valor_total' => 'required|numeric',
        // ]);

        $nota = NotaFiscal::findOrFail($id);

        $nota->save();

        return redirect()->route('notaFiscal.show', $id)->with('success', 'Nota Fiscal atualizada com sucesso!');
    }

    public function destroy(int $id)
    {
        $notaFiscal = NotaFiscal::find($id);
        foreach ($notaFiscal->ordensServico as $os) {
            $os->nota_id = null;
            $os->save();
        }
        $notaFiscal->delete();


        return redirect()->route('notaFiscal.index')->with('success', 'Nota Fiscal Removida com sucesso removida com sucesso!');
    }
}
