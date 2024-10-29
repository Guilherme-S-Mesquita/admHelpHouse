<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function index()
    {
        return view('atendimentos.atendimentos');
    }
}
