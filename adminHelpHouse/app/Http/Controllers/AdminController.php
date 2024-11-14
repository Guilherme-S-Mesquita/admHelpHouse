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






        $cadastrosMesContratantes = Contratante::select([
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('mes')
        ->orderBy('mes', 'asc')
        ->get();
        
        $cadastrosMesProfissionais = Profissional::select([
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('mes')
        ->orderBy('mes', 'asc')
        ->get();
        

     // Contratantes
$mes = [];
$totalContratantes = [];
foreach ($cadastrosMesContratantes as $contratante) {
    $mes[] = $contratante->mes;
    $totalContratantes[] = $contratante->total;
}

// Profissionais
$totalProfissionais = [];
foreach ($cadastrosMesProfissionais as $profissional) {
    $totalProfissionais[] = $profissional->total;
}

// Convertendo arrays para strings
$cadastroMes = implode(',', $mes);
$contratanteTotal = implode(',', $totalContratantes);
$profissionalTotal = implode(',', $totalProfissionais);

return view('/admin/DashboardAdmin', compact(
    'acountContratantes', 'contadorServicos', 'profissionalTotal', 
    'acountContratados', 'contratanteTotal', 'contadorServicosPedidos', 
    'contadorPedidos', 'cadastroMes', 'labels', 'data', 'user'
));
    }
    }





