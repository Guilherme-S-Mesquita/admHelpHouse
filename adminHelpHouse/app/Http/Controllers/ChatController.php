<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Cria ou retorna uma sala de chat existente entre dois usuários
    public function createOrGetChatRoom($contactId, Request $request)
    {
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
        $request->validate([
            'roomId' => 'required|exists:chat_rooms,id',
            'message' => 'required|string',
        ]);

        $newMessage = null;

        // Verifica se o usuário autenticado é um usuário padrão
        if (auth()->check()) {
            $userId = auth()->id();  // ID do usuário padrão
            $newMessage = Chat::create([
                'chat_room_id' => $request->roomId,
                'user_id' => $userId,
                'message' => $request->message,
            ]);

        // Verifica se o usuário é um profissional autenticado
        } elseif (Auth::guard('profissional')->check()) {
            $profissionalId = Auth::guard('profissional')->id();
            $newMessage = Chat::create([
                'chat_room_id' => $request->roomId,
                'message' => $request->message,
                'idcontratado' => $profissionalId,
            ]);

        // Verifica se o usuário é um contratante autenticado
        } elseif (Auth::guard('contratante')->check()) {
            $contratanteId = Auth::guard('contratante')->id();
            $newMessage = Chat::create([
                'chat_room_id' => $request->roomId,
                'message' => $request->message,
                'idcontratante' => $contratanteId,
            ]);
        }

        // Retorna a resposta em JSON com a mensagem criada
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

    // Método para obter o ID do usuário autenticado
    private function getUserId()
    {
        if (auth()->check()) {
            return auth()->id();
        } elseif (Auth::guard('profissional')->check()) {
            return Auth::guard('profissional')->id();
        } elseif (Auth::guard('contratante')->check()) {
            return Auth::guard('contratante')->id();
        }

        return null;
    }
}
