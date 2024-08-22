<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Endereco;

class EnderecoController extends Controller
{


    public function indexApi(){
        $endereco = Endereco::all();

        return $endereco;
    }

    public function storeApiEndereco(Request $request)
    {
        $endereco = new Endereco();

        $endereco->ruaEndereco = $request->ruaEndereco;
        $endereco->cepEndereco = $request->cepEndereco;
        $endereco->numCasaEndereco = $request->numCasaEndereco;
        $endereco->bairroEndereco = $request->bairroEndereco;
        $endereco->cidadeEndereco = $request->cidadeEndereco;
        $endereco->complementoEndereco = $request->complementoEndereco ?? '';
        $endereco->ufEndereco = $request->ufEndereco ?? 'SP'; // Valor padrão definido

        $endereco->save();
    }
    //
}
