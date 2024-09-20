<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Listar todas as salas de chat para o usuário logado
    public function index()
    {
        $userId = Auth::id(); // Obtém o ID do usuário autenticado
    
        // Verificar para 'Contratante' e 'User'
        $chatRooms = ChatRoom::where('participant', 'like', "%{$userId}%")->get();
        
        return response()->json($chatRooms);
    }
    

    // Obter as mensagens de uma sala de chat
    public function getMessages($roomId)
    {
        $messages = Chat::where('chat_room_id', $roomId)
                    ->with(['user', 'contratante']) // Corrigido o uso do with()
                    ->get();
                    
        return response()->json($messages);
    }
    
    // Enviar uma mensagem
    public function sendMessage(Request $request)
    {
        $user = Auth::user(); // Obter o usuário autenticado (seja User ou Contratante)
        $roomId = $request->input('roomId');
        $messageText = $request->input('message');
    
        // Criação da nova mensagem
        $newMessage = Chat::create([
            'chat_room_id' => $roomId,
            'user_id' => $user->id,
            'message' => $messageText,
        ]);
    
        // Transmitir a mensagem em tempo real usando eventos
        event(new \App\Events\SendRealTimeMessage($newMessage->id, $roomId));
    
        return response()->json(['message' => 'Mensagem enviada com sucesso!', 'data' => $newMessage]);
    }
}
    
   


