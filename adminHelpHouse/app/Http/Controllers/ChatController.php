<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Cria ou retorna uma sala de chat existente entre dois usuários
    public function createOrGetChatRoom($contactId, Request $request)
    {
        $user = Auth::user(); // Usuário autenticado (pode ser User, Contratante, ou Profissional)
        $userId = $this->getUserId();

        // Tenta localizar uma sala de chat existente entre o usuário autenticado e o contato
        $chatRoom = ChatRoom::where('participant', "$userId:$contactId")
            ->orWhere('participant', "$contactId:$userId")
            ->first();

        // Se a sala não existir, cria uma nova
        if (!$chatRoom) {
            $chatRoom = ChatRoom::create([
                'participant' => "$userId:$contactId",
            ]);
        }

        return response()->json([
            'status' => 'success',
            'chat_room' => $chatRoom,
        ]);
    }

    // Função para enviar mensagens para uma sala de chat
    public function sendMessage(Request $request)
    {
        $user = Auth::user(); // Usuário autenticado
        $userId = $this->getUserId();

        $request->validate([
            'roomId' => 'required|exists:chat_rooms,id',
            'message' => 'required|string',
        ]);

        // Determinar o tipo de usuário autenticado (User, Contratante ou Profissional)
        $userType = $this->getUserType();

        // Cria e salva a mensagem no banco de dados
        $newMessage = Chat::create([
            'chat_room_id' => $request->roomId,
            'user_id' => $userId,
            'message' => $request->message,
            'user_type' => $userType,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $newMessage,
        ]);
    }

    // Retorna as mensagens de uma sala de chat
    public function getMessages($roomId)
    {
        $messages = Chat::where('chat_room_id', $roomId)
            ->with('user') // Associa as mensagens aos usuários que as enviaram
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages,
        ]);
    }

    // Função auxiliar para determinar o ID do usuário autenticado
    private function getUserId()
    {
        if (Auth::guard('contratante')->check()) {
            return Auth::guard('contratante')->user()->idContratante;
        } elseif (Auth::guard('profissional')->check()) {
            return Auth::guard('profissional')->user()->idContratado;
        } else {
            return Auth::id(); // ID do usuário comum
        }
    }

    // Função auxiliar para determinar o tipo de usuário autenticado
    private function getUserType()
    {
        if (Auth::guard('contratante')->check()) {
            return 'Contratante';
        } elseif (Auth::guard('profissional')->check()) {
            return 'Profissional';
        } else {
            return 'User';
        }
    }
}
