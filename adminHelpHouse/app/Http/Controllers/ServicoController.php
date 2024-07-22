<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;


class ServicoController extends Controller
{

    public function servico(){

        $servicos = Servico::all();
        return view ('add/servico', compact('servicos'));
    }


    public function create()
    {
        return view('add/criarServico');
    }

    public function store(request $request)
    {


        $request->validate([
            'nomeServicos' => 'required|string|max:255',
            'descServicos' => 'required|string',
            'precoServicos' => 'required|string',
        ]);

         $servico = new Servico;
         $servico->nomeServicos = $request->nomeServicos;
         $servico->descServicos = $request->descServicos;
         $servico->precoServicos = $request->precoServicos;


         $servico->save();

         return redirect()->route('add.servico')->with('msg', 'Serviço criado com sucesso!');

    }

    //
}
