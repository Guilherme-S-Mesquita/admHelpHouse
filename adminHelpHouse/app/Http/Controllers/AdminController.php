<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contratante;
use App\Models\Profissional;


class AdminController extends Controller

{


    public function index(){



        $user = auth()->user();

        // cria a variavel de contador, recebe o model e o metodo :: count(); conta quantos cadastros tem na tbcontratantes
        $acountContratantes = Contratante ::count();
        $acountContratados = Profissional ::count();




          return view('/admin/DashboardAdmin', compact('acountContratantes','acountContratados' , 'user')) ;
    }


}


