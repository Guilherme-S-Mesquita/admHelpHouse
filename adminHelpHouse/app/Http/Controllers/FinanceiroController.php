<?php

namespace App\Http\Controllers;

use App\Http\indexFinanceiro;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function indexFinanceiro(){

        return view('financeiro.financeiro');

    }
}
