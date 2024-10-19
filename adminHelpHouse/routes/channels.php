<?php

use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('channel.{roomId}', function ($user, $roomId) {
    if ($user->canJoinRoom($roomId)) {
        return ['id' => $user->id, 'name' => $user->name];
    } elseif (Auth::guard('profissional')->check()) {
        $profissional = Auth::guard('profissional')->user();
        return ['id' => $profissional->idContratado, 'name' => $profissional->nomeContratado];
    } elseif (Auth::guard('contratante')->check()) {
        $contratante = Auth::guard('contratante')->user();
        return ['id' => $contratante->idContratante, 'name' => $contratante->nomeContratante];
    }
    return null;
});


