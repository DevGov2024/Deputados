<?php

namespace App\Http\Controllers;

use App\Models\Deputado;

class DeputadoController extends Controller
{
    public function index()
    {
        $deputados = Deputado::with('despesas')->paginate(10);

        return view('deputados.index', compact('deputados'));
    }
}
