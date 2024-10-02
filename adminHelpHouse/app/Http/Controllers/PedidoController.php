<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use App\Models\Profissional;

class PedidoController extends Controller
{
    // Método para criar um novo pedido
    public function store(Request $request)
    {
        // Validação da requisição
        $validatedData = $request->validate([
            'descricaoPedido' => 'required|string|max:999',
            // 'idServicos' => 'required|integer',
        ]);

        try {
            // Adicionar o idContratante automaticamente (usuário logado)
            $validatedData['idContratante'] = Auth::user()->idContratante;

            // Criar o pedido
            $pedido = Pedido::create($validatedData);

            // Buscar o profissional relacionado ao serviço solicitado
            $profissional = Profissional::whereHas('servicos', function ($query) use ($validatedData) {
                $query->where('idServicos', $validatedData['idServicos']);
            })->first();

            if ($profissional) {
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
