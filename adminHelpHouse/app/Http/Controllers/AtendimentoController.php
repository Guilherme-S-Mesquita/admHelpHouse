<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\DenunciaTratadaMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Profissional;
use App\Models\Denuncia;
use Illuminate\Support\Facades\Auth;
class AtendimentoController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // Filtra denúncias por status
    $denunciasEmAberto = Denuncia::with(['contratante', 'contratado'])
        ->where('status', 'emAberto')
        ->get();

    $denunciasEmAndamento = Denuncia::with(['contratante', 'contratado'])
        ->where('status', 'emAnalise')
        ->get();

    $denunciasConcluidas = Denuncia::with(['contratante', 'contratado'])
        ->where('status', 'concluido')
        ->get();

    // Retorna as denúncias filtradas para a view
    return view('atendimentos.atendimentos', compact(
        'user',
        'denunciasEmAberto',
        'denunciasEmAndamento',
        'denunciasConcluidas'
    ));
}


    public function store(Request $request)
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return response()->json(['error' => 'Usuário não autenticado.'], 403);
        }

        // Valida os campos do request
        $validateData = $request->validate([
            'descricao' => 'required|string|max:300',
            'idContratante' => 'required|uuid',
            'idContratado' => 'required|uuid',
            'categoria' => 'required|string',
            'status' => 'required|string|in:emAberto', // Validação corrigida
            'imagemDenuncia'=>"nullable|string",
        ]);

        try {
            // Obtém o ID do contratante autenticado
            $request['idContratante'] = Auth::user()->idContratante;


            $denuncia = Denuncia::create($validateData);

            // Obtém o profissional denunciado
            $profissional = Profissional::findOrFail($request->idContratado);

            return response()->json([
                'message' => 'Denúncia realizada com sucesso.',
                'denuncia' => $denuncia,
                'profissional' => $profissional->nomeContratado,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erro ao criar denúncia: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao criar denúncia.'], 500);
        }
    }

    public function acaoAnalise($idDenuncia, Request $request)
    {
        $denuncia = Denuncia::with('contratante')
            ->select('id', 'descricao', 'categoria', 'status', 'idContratante', 'created_at')
            ->where('id', $idDenuncia)
            ->firstOrFail();

        $acao = $request->input('acao');

        if (in_array($acao, ['emAnalise', 'concluido'])) {
            $denuncia->status = $acao;
            $denuncia->save();

            $emailContratante = $denuncia->contratante->emailContratante ?? null;

            if ($emailContratante) {
                $msg = $acao === 'emAnalise'
                    ? 'O pedido de denúncia está em análise. Por favor, aguarde 2 dias úteis para uma resposta.'
                    : 'A denúncia foi concluída. Obrigado por utilizar nossos serviços.';

                Mail::to($emailContratante)->send(new DenunciaTratadaMail($msg));
            }


            
            return response()->json(['message' => "Denúncia atualizada para \"$acao\" com sucesso!"]);
        }
        return response()->json(['error' => 'Ação inválida.'], 400);
    }


        public function mostrarDenunciasEmAnalise (){



            $denuncias = Denuncia::with([
                'profissional' => function ($query){
                    $query->select('nomeContratado', 'emailContratado','cpfContratado');
                },
                'contratatante'=> function ($query){
                    $query->select('nomeContratante', 'emailContratante','cpfContratante');
                }
            ])
                ->where('status', 'emAnalise')
                ->get();

            if ($denuncias->isEmpty()) {
                    return response()->json(['message' => 'Nenhum pedido foi realizado a você']);
                }

                return response()->json($denuncias);

        }

        public function suspenderContaPro($idContratado){

            $profissional = Profissional::findOrFail($idContratado);
            $profissional -> is_suspend = true;
            $profissional->save();

            $mensagem = 'Sua conta foi suspensa devido a uma denúncia em análise. Entre em contato com o suporte para mais informações.';
            Mail::to($profissional->emailContratado)->send(new DenunciaTratadaMail($mensagem));

            return response()->json(['message' => 'A conta foi suspensa com sucesso e o e-mail foi enviado.']);

        }


}
