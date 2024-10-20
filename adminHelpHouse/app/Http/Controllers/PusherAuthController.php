<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class PusherAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // Verifique se o usuário está autenticado usando sua lógica de autenticação
        if (Auth::check()) { // Ou seu sistema de autenticação baseado em tokens
            // Retorna a resposta necessária para o Pusher
            return Broadcast::auth($request);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
