<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profissional;
// use App\Notifications\NovoPedidoNotification;

class PedidoController extends Controller
{
    // Listar todos os pedidos (apenas exemplo)
    public function IndexPedido()
    {
        $pedidos = Pedido::all();
        return $pedidos;
    }

    // Método para criar um novo pedido
    public function store(Request $request)
    {
        // Validação da requisição
        $validatedData = $request->validate([
            'descricaoPedido' => 'required|string|max:999',
            'idServicos' => 'required|integer',
        ]);

        try {
            // Adicionar o idContratante automaticamente (usuário logado)
            $validatedData['idContratante'] = Auth::user()->idContratante;

            // Criar o pedido
            $pedido = Pedido::create($validatedData);

            // Buscar o profissional relacionado ao serviço solicitado
            $profissional = Profissional::whereHas('servicos', function ($query) use ($validatedData) {
                // Defina explicitamente a tabela de onde vem a coluna idServicos
                $query->where('tbservicos.idServicos', $validatedData['idServicos']);
            })->first();


            if ($profissional) {
                // Notificar o profissional (opcional)
                // $profissional->notify(new NovoPedidoNotification($pedido));

                // Retornar o profissional encontrado junto com o pedido
                return response()->json([
                    'message' => 'Pedido criado com sucesso!',
                    'pedido' => $pedido,
                    'profissional' => $profissional
                ], 201);
            }

            // Se não encontrar um profissional
            return response()->json(['message' => 'Pedido criado, mas nenhum profissional encontrado.'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar o pedido: ' . $e->getMessage()], 500);
        }
    }
}
