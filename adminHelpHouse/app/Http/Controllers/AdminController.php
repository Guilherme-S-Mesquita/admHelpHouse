<?php

namespace App\Http\Controllers;
use App\Models\Contratante;
use App\Models\Profissional;
use App\Models\Pedido;
use App\Models\Servico;

use Illuminate\Support\Facades\DB;




class AdminController extends Controller

{


    public function index(){



        $user = auth()->user();

        // cria a variavel de contador, recebe o model e o metodo :: count(); conta quantos cadastros tem na tbcontratantes
        $acountContratantes = Contratante ::count();
        $acountContratados = Profissional ::count();
        $contadorServicos = Servico ::count();
        $contadorPedidos = Pedido ::count();


        $contadorServicosPedidos = Pedido::join('tbservicos', 'tbSolicitarPedido.idServicos', '=', 'tbservicos.idServicos')
            ->select('tbservicos.nomeServicos', DB::raw('count(tbSolicitarPedido.idSolicitarPedido) as total'))
            ->groupBy('tbservicos.nomeServicos')
            ->get();




        $labels = $contadorServicosPedidos->pluck('nomeServicos');
        $data = $contadorServicosPedidos->pluck('total');






        $cadastrosMes = Contratante::select([
            DB::raw('MONTH(created_at)as mes'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('mes')
        ->orderBy('mes', 'asc')
        ->get();

        $cadastrosMes = Profissional::select([
            DB::raw('MONTH(created_at)as mes'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('mes')
        ->orderBy('mes', 'asc')
        ->get();

        foreach($cadastrosMes as $profissional){
            $mes[] = $profissional->mes;
            $total[] = $profissional->total;
        }

            foreach($cadastrosMes as $contratante){
                $total[] = $contratante->total;
            }

            $cadastroMes = implode(',', $mes ?? [1,2,3]);
            $contratanteTotal = implode(',', $total ?? [12]);
            $profissionalTotal = implode(',', $total ??[10]);


        return view('/admin/DashboardAdmin',
        compact(
          'acountContratantes','contadorServicos','profissionalTotal','acountContratados' , 'contratanteTotal', 'contadorServicosPedidos', 'contadorPedidos','cadastroMes','labels', 'data', 'user')) ;

        }
    }





