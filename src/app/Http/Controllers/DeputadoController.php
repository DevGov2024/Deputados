<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Deputado;

class DeputadoController extends Controller
{
   public function index(Request $request)
{
    $query = Deputado::with('despesas');

    if ($request->filled('nome')) {
        $query->where('nome', 'like', '%' . $request->nome . '%');
    }

    if ($request->filled('uf')) {
        $query->where('sigla_uf', $request->uf);
    }

    if ($request->filled('partido')) {
        $query->where('sigla_partido', $request->partido);
    }

   
   $deputados = $query->simplePaginate(10);
    // para popular os selects
    $ufs = Deputado::select('sigla_uf')->distinct()->pluck('sigla_uf');
    $partidos = Deputado::select('sigla_partido')->distinct()->pluck('sigla_partido');

    return view('deputados.index', compact('deputados', 'ufs', 'partidos'));
}

}
