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


    public function storeApi(Request $request)
    {
        $validatedData = $request->validate([
            'nomeContratante' => 'required|string',
            'cpfContratante' => 'required|string',
            'password' => 'required|string',
            'emailContratante' => 'required|email',
            'telefoneContratante' => 'required|string',
            'ruaContratante' => 'required|string',
            'cepContratante' => 'required|string', 
            'numCasaContratante' => 'required|string',
            'complementoContratante' => 'required|string',
            'bairroContratante' => 'required|string',
        ]);
    
        $contratante = new Contratante($validatedData);
        $contratante->save();
    
        return response()->json($contratante, 200);
    }
    
};


