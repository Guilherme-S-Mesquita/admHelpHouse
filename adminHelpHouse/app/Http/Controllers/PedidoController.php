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
            'idContratado' => 'required|uuid',  // UUID do profissional
            'tituloPedido' => 'required|string|max:50'
        ]);

        try {
            // Obter o UUID do contratante logado
            $validatedData['idContratante'] = Auth::user()->idContratante;

            // Criar o pedido no banco
            $pedido = Pedido::create($validatedData);

            // Verificar se o UUID do profissional é válido
            $profissional = Profissional::where('id', $validatedData['idContratado'])->first();

            if ($profissional) {
                // Pedido criado com sucesso e o profissional foi encontrado
                return response()->json([
                    'message' => 'Pedido criado com sucesso!',
                    'pedido' => $pedido,
                    'profissional' => $profissional
                ], 201);
            } else {
                // Caso o profissional não seja encontrado
                return response()->json(['message' => 'Pedido criado, mas nenhum profissional encontrado com esse ID.'], 201);
            }
        } catch (\Exception $e) {
            // Tratar erros
            return response()->json(['error' => 'Erro ao criar o pedido: ' . $e->getMessage()], 500);
        }
    }


    public function pedidosPendentes()
    {
        // Obtem o ID do profissional autenticado
        $profissionalId = Auth::guard('profissional')->id();

        $pedido= Pedido::select('pedido')
        ->where('idContratado', $profissionalId)
        ->where('status', 'pendente')
        ->get();

        // Busca os pedidos para o profissional autenticado com status pendente
        $pedidos = Pedido::where('idContratado', $profissionalId)
            ->where('statusPedido', 'pendente')
            ->with('contratante')
            ->get();

        return response()->json($pedido);
    }


    public function responderPedido(Request $request, $id)
    {
        // Validação da requisição
        $validacao = $request->validate([
            'acao' => 'required|in:aceito,recusado',
        ]);

        // Busca o pedido pelo ID
        $pedido = Pedido::findOrFail($id);

        // Obtem o ID do profissional autenticado
        $profissionalId = Auth::guard('profissional')->id();

        // Verifica se o profissional autenticado é o dono do pedido
        if ($pedido->idContratado !== $profissionalId) {
            return response()->json(['error' => 'Você não está autorizado a responder este pedido.'], 403);
        }

        // Atualiza o status do pedido de acordo com a ação (aceitar ou recusar)
        $pedido->statusPedido = $validacao['acao'];
        $pedido->save();

        return response()->json(['message' => 'Pedido ' . $validacao['acao'] . ' com sucesso!']);
    }


}
