<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contratante;

class ContratanteController extends Controller
{
    public function indexApi()
    {
        $contratante = Contratante::all();
        return $contratante;
    }
};


public function storeApi(Request $request)
{
    $contratante = new Contratante();

    $contratante->nomeContratante = $request->nomeContratante;
  
    $contratante->save();
}
