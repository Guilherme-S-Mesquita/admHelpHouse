<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{


    public function indexPedido()
    {

        $pedidos = Pedido::all();
        return $pedidos;

    }
    public function store(Request $request)
    {

            // Validação da requisição
            $validatedData = $request->validate([
                'descricaoPedido' => 'required|string|max:999',
                'servicoPedido' => 'required|string',
                'idServicos' => 'required|integer',
                'idContratante'=>'string'
            ]);

 

            // Criando um novo pedido
            try {
                Pedido::create($validatedData);
                return response()->json(['message' => 'Pedido criado com sucesso!'], 201);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }

    }
}
