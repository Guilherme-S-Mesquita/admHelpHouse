<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profissional;


class ProfissionalApiController extends Controller
{

    public function indexApiPro(){

        $profissionais = Profissional::all();

        return $profissionais;

    }

    public function storeApiPro(Request $request)
    {

        $profissional = new Profissional();

        $profissional-> nomeContratado = $request -> nomeContratado;
        $profissional->sobrenomeContratado = $request->sobrenomeContratado;
        $profissional-> cpfContratado = $request -> cpfContratado;
        $profissional-> emailContratado = $request -> emailContratado;
        $profissional-> telefoneContratado = $request -> telefoneContratado;
        $profissional-> senhaContratado = $request -> senhaContratado;
        $profissional-> descContratado = $request -> descContratado;
        $profissional-> nascContratado = $request -> nascContratado;
        $profissional-> password = $request -> password;
        $profissional->idEndereco = $request->idEndereco;  // Adicione esta linha para incluir o idEndereco



        $profissional->save();



    }
    //
}
// 'idContratado',
// 'nomeContratado',
// 'cpfContratado',
// 'emailContratado',
// 'telefoneContratado',
// 'senhaContratado',
// 'profissaoContratado',
// 'descContratado',
// 'nascContratado',
// 'care'
