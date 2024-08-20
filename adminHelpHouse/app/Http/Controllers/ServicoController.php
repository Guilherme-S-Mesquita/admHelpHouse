<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Servico;

class ServicoController extends Controller
{
    public function servico()
    {
        $servicos = Servico::all();
        return view('add.servico', compact('servicos'));
    }

    public function servicoApi()
    {
        $servicos = Servico::all();
        return $servicos;
    }

    public function create()
    {
        return view('add.criarServico');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomeServicos' => 'required|string|max:255',
            'descServicos' => 'required|string',
            'precoServicos' => 'required|string',
            'idContratado' => 'required|integer',  // Adicione esta validação
        ]);

        $servico = new Servico;
        $servico->nomeServicos = $request->nomeServicos;
        $servico->descServicos = $request->descServicos;
        $servico->precoServicos = $request->precoServicos;

        $servico->save();

        return redirect()->route('add.servico')->with('msg', 'Serviço criado com sucesso!');
    }

    public function edit($idServicos)
    {
        // Certifique-se de usar findOrFail para lidar com IDs inexistentes
        $servico = Servico::findOrFail($idServicos);

        // Retorne a view de edição com o serviço específico
        return view('add.editServico', compact('servico'));
    }

    public function update(Request $request, $idServicos)
    {
        $request->validate([
            'nomeServicos' => 'required|string|max:255',
            'descServicos' => 'required|string',
            'precoServicos' => 'required|string',
        ]);

        $servico = Servico::findOrFail($idServicos);
        $servico->nomeServicos = $request->nomeServicos;
        $servico->descServicos = $request->descServicos;
        $servico->precoServicos = $request->precoServicos;

        $servico->save();

        return redirect()->route('add.servico')->with('msg', 'Serviço atualizado com sucesso!');
    }
    public function destroy($idServicos){

        Servico::findOrFail($idServicos)->delete();

        return redirect()->route('add.servico')->with('msg', 'Serviço excluido com sucesso!');
    }
}
