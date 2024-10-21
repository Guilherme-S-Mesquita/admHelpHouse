<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('channel.{roomId}', function ($user, $roomId) {
    Log::info("Tentativa de acesso ao canal {$roomId} pelo usuário {$user->id}");

    if ($user && $user->canJoinRoom($roomId)) {
        Log::info("Usuário padrão {$user->id} pode entrar na sala {$roomId}.");
        return ['id' => $user->id, 'name' => $user->name];
    }

    if (Auth::guard('profissional')->check()) {
        $profissional = Auth::guard('profissional')->user();
        if ($profissional && $profissional->canJoinRoom($roomId)) {
            return ['idContratado' => $profissional->idContratado, 'nomeContratado' => $profissional->nomeContratado];
        }
    }

    if (Auth::guard('contratante')->check()) {
        $contratante = Auth::guard('contratante')->user();
        if ($contratante && $contratante->canJoinRoom($roomId)) {
            return ['idContratante' => $contratante->idContratante, 'nomeContratante' => $contratante->nomeContratante];
        }
    }

    Log::warning("Usuário {$user->id} não autorizado a entrar na sala {$roomId}.");
    return null;
});

