<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profissional;

class PedidoController extends Controller
{
    // Listar todos os pedidos
    public function index()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos);
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
            $profissional = Profissional::find($validatedData['idContratado']);

            return response()->json([
                'message' => 'Pedido criado com sucesso!',
                'pedido' => $pedido,
                'profissional' => $profissional ?: 'Nenhum profissional encontrado.'
            ], 201);
        } catch (\Exception $e) {
            // Tratar erros
            return response()->json(['error' => 'Erro ao criar o pedido: ' . $e->getMessage()], 500);
        }
    }

    // Método para listar pedidos pendentes
    public function pedidosPendentes()
    {
        $profissional = Auth::guard('profissional')->user();

        if (!$profissional) {
            return response()->json(['error' => 'Nenhum profissional autenticado'], 400);
        }

        $pedidos = Pedido::select('idSolicitarPedido', 'descricaoPedido', 'idContratante')
            ->where('idContratado', $profissional->idContratado)
            ->where('status', 'pendente')
            ->get();

        return response()->json($pedidos);
    }

    // Método para responder a um pedido
    public function responderPedido(Request $request, $id)
    {
        // Validação da requisição
        $validacao = $request->validate([
            'acao' => 'required|in:aceito,recusado',
        ]);

        // Busca o pedido pelo ID
        $pedido = Pedido::findOrFail($id);
        $profissionalId = Auth::guard('profissional')->id();

        // Verifica se o profissional autenticado é o dono do pedido
        if ($pedido->idContratado !== $profissionalId) {
            return response()->json(['error' => 'Você não está autorizado a responder este pedido.'], 403);
        }

        // Atualiza o status do pedido
        $pedido->statusPedido = $validacao['acao'];
        $pedido->save();

        return response()->json(['message' => 'Pedido ' . $validacao['acao'] . ' com sucesso!']);
    }
}
