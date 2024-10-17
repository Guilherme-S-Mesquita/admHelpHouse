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
        // Validação dos dados da requisição
        $request->validate([
            'roomId' => 'required|exists:chat_rooms,id',
            'message' => 'required|string',
        ]);

        $newMessage = null;
        $senderType = null;

        // Verifica se há um usuário autenticado
        if (Auth::check()) {
            $user = Auth::user();

            // Verifica se é um usuário padrão
            if ($user instanceof \App\Models\User) {
                $newMessage = Chat::create([
                    'chat_room_id' => $request->roomId,
                    'user_id' => $user->id,
                    'message' => $request->message,
                ]);
                $senderType = 'user';  // Marca como usuário padrão

            } elseif ($user instanceof \App\Models\Profissional) {
                $newMessage = Chat::create([
                    'chat_room_id' => $request->roomId,
                    'message' => $request->message,
                    'idContratado' => $user->idContratado,
                ]);
                $senderType = 'profissional';  // Marca como profissional

            } elseif ($user instanceof \App\Models\Contratante) {
                $newMessage = Chat::create([
                    'chat_room_id' => $request->roomId,
                    'message' => $request->message,
                    'idContratante' => $user->idContratante,
                ]);
                $senderType = 'contratante';  // Marca como contratante
            }
        }

        if (!$newMessage) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuário não autenticado.',
            ], 401);
        }

        // Carrega o remetente e suas informações
        $newMessage->load($senderType); // Carrega o remetente baseado no tipo

        // Retorna a resposta em JSON com a mensagem e o remetente
        return response()->json([
            'status' => 'success',
            'message' => $newMessage,
            'sender' => $newMessage->$senderType  // Retorna as informações do remetente
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
