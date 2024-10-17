<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profissional;
use App\Models\Contratante;

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

            if (!$profissional) {
                return response()->json(['error' => 'Profissional não encontrado'], 404);
            }

            return response()->json([
                'message' => 'Pedido criado com sucesso!',
                'pedido' => $pedido,
                'profissional' => $profissional->nomeContratado
            ], 201);
        } catch (\Exception $e) {
            // Tratar erros
            return response()->json(['error' => 'Erro ao criar o pedido: ' . $e->getMessage()], 500);
        }
    }

    // Método para listar pedidos pendentes
    public function pedidosPendentes()
    {
        try {
            $profissionalId = Auth::user()->idContratado;

            // Verifica se o profissional está autenticado
            if (!$profissionalId) {
                return response()->json(['error' => 'Profissional não autenticado'], 401);
            }

            // Busca os pedidos pendentes para o profissional autenticado
            $pedidos = Pedido::with(['contratante' => function ($query) {
                $query->select('idContratante', 'nomeContratante', 'emailContratante', 'telefoneContratante', 'cidadeContratante', 'bairroContratante');
            }])
            ->select('idSolicitarPedido', 'descricaoPedido', 'idContratante', 'tituloPedido', 'statusPedido')
            ->where('idContratado', $profissionalId)
            ->where('statusPedido', 'pendente')
            ->get();

            return response()->json($pedidos);
        } catch (\Exception $e) {
            // Retorna um erro caso algo ocorra
            return response()->json(['error' => 'Erro ao buscar pedidos: ' . $e->getMessage()], 500);
        }
    }

    // Método para responder a um pedido
    public function meusPedidos()
    {
        try {
            $idContratante = Auth::user()->idContratante;

            $contratante = Contratante::with(['pedidos' => function ($query) {
                $query->select('idSolicitarPedido', 'tituloPedido', 'idContratado', 'idContratante')
                      ->with(['contratado:idContratado,nomeContratado']);
            }])
            ->where('idContratante', $idContratante)
            ->first();

            if (!$contratante) {
                return response()->json(['message' => 'Contratante não encontrado'], 404);
            }

            return response()->json($contratante);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar pedidos: ' . $e->getMessage()], 500);
        }
    }
}
