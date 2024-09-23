<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatRoom;
use App\Models\Contratante;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Recupera todas as mensagens de uma sala de chat específica
    public function getMessages($roomId)
    {
        // Busca as mensagens da sala de chat, ordenando por data de criação
        $messages = Chat::where('chat_room_id', $roomId)
            ->with('user', 'contratante', 'profissional') // Inclui as relações
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // Envia uma nova mensagem
    public function sendMessage(Request $request)
    {
        // Verifica se a mensagem foi enviada e se o usuário está autenticado
        $this->validate($request, [
            'message' => 'required|string',
            'roomId' => 'required|string'
        ]);

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $authenticatedUser = auth()->user();
            $userType = ''; // Inicializa com valor padrão
            $contratanteId = null;
            $profissionalId = null;

            // Identifica o tipo de usuário
            if (Auth::guard('contratante')->check()) {
                $userType = 'Contratante';
                $contratanteId = Auth::guard('contratante')->user()->idContratante;
            } elseif (Auth::guard('profissional')->check()) {
                $userType = 'Profissional';
                $profissionalId = Auth::guard('profissional')->user()->idContratado;
            } elseif ($authenticatedUser instanceof User) {
                $userType = 'User';
            }

            // Cria a nova mensagem no banco de dados
            $newMessage = Chat::create([
                'chat_room_id' => $request->roomId,
                'user_id' => $userId,
                'message' => $request->message,
                'user_type' => $userType,
                'idContratante' => $contratanteId,
                'idContratado' => $profissionalId,
            ]);

            // Dispara o evento de mensagem em tempo real
            event(new \App\Events\SendRealTimeMessage($newMessage->id, $request->roomId));

            return response()->json(['message' => 'Message sent successfully', 'data' => $newMessage], 201);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Lista todas as salas de chat disponíveis para o usuário logado
    public function index()
    {
        if (auth()->check()) {
            // Recupera todas as salas de chat em que o usuário está envolvido
            $userId = auth()->user()->id;

            // Filtra as salas que contêm o usuário autenticado
            $chatRooms = ChatRoom::where('participant', 'LIKE', "%$userId%")
                ->with('messages')
                ->get();

            return response()->json($chatRooms);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
