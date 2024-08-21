<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contratante;
use App\Models\Profissional;


class AdminController extends Controller

{


    public function api(){
        $profissionais = Profissional::all();  // Coletando todos os registros da tabela "Profissional"

        foreach($profissioanis as $pro )
        echo "$pro->idContratante";
        echo "$pro->nomeContratante";
        echo "$pro->cpfContratante";
        echo "$pro->emailContratante";
        echo "<br />";

        return response()->json($profissionais);  // Retornando a resposta em formato JSON
        
    }


    public function index(){



        $user = auth()->user();

        // cria a variavel de contador, recebe o model e o metodo :: count(); conta quantos cadastros tem na tbcontratantes
        $acountContratantes = Contratante ::count();
        $acountContratados = Profissional ::count();




          return view('/admin/DashboardAdmin', compact('acountContratantes','acountContratados' , 'user')) ;
    }


}


