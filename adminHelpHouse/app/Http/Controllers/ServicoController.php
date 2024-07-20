<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;


class ServicoController extends Controller
{

    public function servico(){


        return view ('add/servico');
    }


    public function create()
    {
        return view('create');
    }

    public function store(){

        return view ('/criarServico');

    }

    //
}
