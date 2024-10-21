<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('channel.{roomId}', function ($user, $roomId) {
    Log::info("Tentativa de acesso ao canal {$roomId} pelo usuário {$user->id}");

    if (Auth::check()) {
        $user = Auth::user();

        if ($user instanceof \App\Models\User && $user->canJoinRoom($roomId)) {
            return ['id' => $user->id, 'name' => $user->name];
            Log::info("Usuário padrão {$user->id} pode entrar na sala {$roomId}.");

        }elseif  ($user instanceof \App\Models\Contratante && $user->canJoinRoom($roomId)){
            return ['id' => $user->id, 'nomeContratante' => $user->nomeContratante];
            Log::info("Usuário padrão {$user->id} pode entrar na sala {$roomId}.");

        }elseif  ($user instanceof \App\Models\Profissional && $user->canJoinRoom($roomId)){
            return ['id' => $user->id, 'nomeContratado' => $user->nomeContratado];
            Log::info("Usuário padrão {$user->id} pode entrar na sala {$roomId}.");
        }
    }

    Log::warning("Usuário {$user->id} não autorizado a entrar na sala {$roomId}.");
    return null;
});
