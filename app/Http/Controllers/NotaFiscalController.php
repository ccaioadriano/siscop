<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
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

    public function show(int $id)
    {
        $nota = NotaFiscal::find($id);
        return view("notaFiscal.show", compact('nota'));
    }
}
