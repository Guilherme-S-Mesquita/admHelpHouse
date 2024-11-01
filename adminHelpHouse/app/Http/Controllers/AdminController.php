<?php

namespace App\Http\Controllers;
use App\Models\Contratante;
use App\Models\Profissional;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller

{


    public function index(){



        $user = auth()->user();

        // cria a variavel de contador, recebe o model e o metodo :: count(); conta quantos cadastros tem na tbcontratantes
        $acountContratantes = Contratante ::count();
        $acountContratados = Profissional ::count();

        $contadorPedidos = Pedido ::count();

        $contadorServicosPedidos = Pedido::with('servico')
        ->select('idServicos', DB::raw('count(*) as total'))
        ->groupBy('idServicos')
        ->get();// Retorna um array com [idServicos => total]





        $labels = $contadorServicosPedidos->map(fn($pedido) => $pedido->servico->nomeServicos);
        $data = $contadorServicosPedidos->pluck('total');

        return view('/admin/DashboardAdmin',
        compact(
          'acountContratantes','acountContratados' , 'user', 'contadorServicosPedidos', 'contadorPedidos', 'labels', 'data')) ;
  }
    }





