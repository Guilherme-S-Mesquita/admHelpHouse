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
        dd($request->all());

        $profissional = new Profissional();

        $profissional-> nomeContratado = $request -> nomeContratado;
        $profissional->sobrenomeContratado = $request->sobrenomeContratado;
        $profissional-> cpfContratado = $request -> cpfContratado;
        $profissional->password = $request ->password;
        $profissional-> emailContratado = $request -> emailContratado;
        $profissional-> profissaoContratado = $request -> profissaoContratado;
        $profissional-> telefoneContratado = $request -> telefoneContratado;
        $profissional-> descContratado = $request -> descContratado;
        $profissional-> nascContratado = $request -> nascContratado;

        $profissional-> ruaContratado = $request -> ruaContratado;
        $profissional-> cepContratado = $request -> cepContratado;
        $profissional-> bairroContratado = $request -> bairroContratado;
        $profissional-> numCasaContratado = $request -> numCasaContratado;
        $profissional-> complementoContratado = $request -> complementoContratado;
        $profissional-> ufContratado = $request -> ufContratado;
        $profissional-> cidadeContratado = $request -> cidadeContratado;





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
