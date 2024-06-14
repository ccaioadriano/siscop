<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $ordens = OrdemServico::all();
        return view("ordemServico.index", compact("ordens"));
    }
}
