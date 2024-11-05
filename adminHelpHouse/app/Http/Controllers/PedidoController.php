<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Pedido;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profissional;
use App\Models\Contratante;


use Illuminate\Validation\ValidationException;

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
                'profissional' => $profissional->nomeContratado ?: 'Nenhum profissional encontrado.'
            ], 201);
        } catch (\Exception $e) {
            // Tratar erros
            $erro= $e;
            Log::info("Mensagem criada: ".$erro);
            return response()->json(['error' => 'Erro ao criar o pedido: ' . $e->getMessage()], 500);
        }
    }

    // Método para listar pedidos pendentes
    public function pedidosPendentes()
    {
        $profissional['idContratado'] = Auth::user()->idContratado;

        if (!$profissional) {
            return response()->json(['error' => 'Nenhum profissional autenticado'], 400);
        }

        // Busca os pedidos pendentes e inclui os dados do contratante através do relacionamento
        $pedidos = Pedido::with([
            'contratante' => function ($query) {
                $query->select('idContratante', 'nomeContratante', 'emailContratante', 'telefoneContratante', 'cidadeContratante', 'bairroContratante'); // Campos do contratante que você quer trazer
            }
        ])
            ->select('idSolicitarPedido', 'descricaoPedido', 'idContratante', 'tituloPedido', 'statusPedido')
            ->where('idContratado', $profissional)
            ->where('statusPedido', 'pendente')
            ->get();

        return response()->json($pedidos);
    }

    // Método para responder a um pedido
    public function meusPedidos()
    {
        $idContratante['idContratante'] = Auth::user()->idContratante;




        $contratante = Contratante::with([
            'pedidos' => function ($query) {
                $query->select('idSolicitarPedido', 'tituloPedido', 'idContratado', 'idContratante')
                    ->with(['contratado:idContratado,nomeContratado']);
            }
        ])
            ->where('idContratante', $idContratante)
            ->first();

        if (!$contratante) {
            return response()->json(['message' => 'Contratante não encontrado'], 404);
        }

        return response()->json($contratante);
    }
    public function meusPedidosAceitos()
    {
        $idContratado = Auth::user()->idContratado;

        // Executa a consulta e inclui dados do contratante e do contrato
        $pedidos = Pedido::with([
            'contratante' => function ($query) {
                $query->select('idContratante', 'nomeContratante', 'emailContratante', 'telefoneContratante', 'cidadeContratante', 'bairroContratante');
            },
            'contrato' => function ($query) {
                $query->select('id', 'idSolicitarPedido', 'valor', 'data', 'hora', 'desc_servicoRealizado', 'forma_pagamento', 'status');
            }
        ])
        ->where('statusPedido', 'aceito')
        ->whereIn('andamentoPedido', ['andamento', 'concluido'])
        ->where('idContratado', $idContratado)
        ->get();

        // Verifica se existem pedidos
        if ($pedidos->isEmpty()) {
            return response()->json(['message' => 'Nenhum pedido foi realizado a você']);
        }

        return response()->json($pedidos);
    }


    public function storeContrato(Request $request, $idSolicitarPedido)
    {
        try {
            $request->validate([
                'valor' => 'required|string',
                'data' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'forma_pagamento' => 'required|string',
            ]);

            // Buscar o pedido e verificar se existe
            $pedido = Pedido::findOrFail($idSolicitarPedido);

            // Atualizar o status do pedido para 'aceito'
            $pedido->statusPedido = 'aceito';
            $pedido->save();

            // Criar o contrato relacionado ao pedido
            $contrato = $pedido->contrato()->create([
                'idContratante' => $pedido->idContratante,
                'idContratado' => $pedido->idContratado,
                'valor' => $request->valor,
                'data' => $request->data,
                'hora' => $request->hora,
                'desc_servicoRealizado'=>$request->desc_servicoRealizado,
                'tipo_servico' => $pedido->tituloPedido,
                'status' => 'pendente',
                'forma_pagamento' => $request->forma_pagamento
            ]);

            return response()->json([
                'message' => 'Contrato criado com sucesso e pedido aceito!',
                'contrato' => $contrato,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar contrato: ' . $e->getMessage()], 500);
        }
    }




    public function andamentoPedido($idSolicitarPedido)
    {
        $pedido = Pedido::findOrFail($idSolicitarPedido);
    
        if ($pedido->statusPedido !== 'aceito') {
            return response()->json(['message' => 'Pedido não pode ser iniciado, pois não foi aceito'], 403);
        }
    
        $pedido->andamentoPedido = 'em_andamento';
        $pedido->data_inicio = now();
        $pedido->save();
    
        return response()->json(['message' => 'Pedido está em andamento!', 'pedido' => $pedido]);
    }
    


    public function finalizarPedido($idSolicitarPedido)
    {
        $pedido = Pedido::findOrFail($idSolicitarPedido);
    
        if ($pedido->andamentoPedido !== 'em_andamento') {
            return response()->json(['message' => 'Pedido não pode ser finalizado, pois ainda não está em andamento'], 403);
        }
    
        $pedido->andamentoPedido = 'concluido';
        $pedido->statusPedido = 'concluido'; // Marca como finalizado
        $pedido->data_conclusao = now();
        $pedido->save();
    
        return response()->json(['message' => 'Pedido finalizado com sucesso!', 'pedido' => $pedido]);
    }



}
