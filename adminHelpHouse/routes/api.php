<?php

use App\Http\Controllers\PedidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfissionalApiController;
use App\Http\Controllers\ContratanteController;
use App\Http\Controllers\ChatController;







//contrataDO/profissional
Route::get('/pro' ,[ProfissionalApiController::class, 'indexApiPro']);
Route::post('/proo' ,[ProfissionalApiController::class, 'storeApiPro']);
Route::post('/authpro' ,[ProfissionalApiController::class, 'authPro']);


// ´------------------------CONTRATANTE API
Route::get('/cli' ,[ContratanteController::class, 'indexApi']);
Route::get('/cli/{id}' ,[ContratanteController::class, 'showApi']);
Route::post('/clii' ,[ContratanteController::class, 'storeApi']) ;
Route::post('/auth' ,[ContratanteController::class, 'auth']) ;


Route::get('/pedidos' ,[PedidoController::class, 'indexPedido']);
Route::post('/pedido' ,[PedidoController::class, 'store']) ;



    // Rota para criar ou obter uma sala de chat
    Route::post('/chat-room/{contactId}', [ChatController::class, 'createOrGetChatRoom']);

    // Rota para enviar mensagens
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);

    // Rota para obter as mensagens de uma sala de chat
    Route::get('/chat/messages/{roomId}', [ChatController::class, 'getMessages']);


