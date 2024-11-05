<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Avaliacao; 


class AvaliacaoController extends Controller
{

    public function index()
    {
        $avaliacao = Avaliacao::all();
        return $avaliacao;
    }

    // Método para criar uma nova avaliação
    public function store(Request $request)
    {
        // Valida os dados de entrada
        $validated = $request->validate([
            'idContratado' => 'required|string',
            'idContratante' => 'required|string',
            'ratingAvaliacao' => 'required|integer|min:1|max:5',
            'descavaliacao' => 'nullable|string|max:255', // Alterado para texto
        ]);

        try {
            // Cria a avaliação
            $avaliacao = Avaliacao::create([
                'idContratado' => $validated['idContratado'],
                'idContratante' => $validated['idContratante'],
                'ratingAvaliacao' => $validated['ratingAvaliacao'],
                'descavaliacao' => $validated['descavaliacao'] ?? null,
            ]);

            return response()->json([
                'status' => 'success',
                'avaliacao' => $avaliacao,
            ], 201);

        } catch (\Exception $e) {
            // Loga o erro em caso de falha
            Log::error("Erro ao salvar avaliação: " . $e);
            return response()->json([
                'status' => 'error',
                'message' => 'Falha ao salvar a avaliação.',
            ], 500);
        }
    }

}
