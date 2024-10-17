<?php

use App\Http\Controllers\PedidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfissionalApiController;
use App\Http\Controllers\ContratanteController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ServicoController;







//contrataDO/profissional
Route::get('/pro' ,[ProfissionalApiController::class, 'indexApiPro']);
Route::get('/pro/{id}' ,[ProfissionalApiController::class, 'showApi']);
Route::post('/proo' ,[ProfissionalApiController::class, 'storeApiPro']);
Route::post('/authpro' ,[ProfissionalApiController::class, 'authPro']);


// ´------------------------CONTRATANTE API
Route::get('/cli' ,[ContratanteController::class, 'indexApi']);
Route::get('/cli/{id}' ,[ContratanteController::class, 'showApi']);
Route::post('/clii' ,[ContratanteController::class, 'storeApi']) ;
Route::post('/auth' ,[ContratanteController::class, 'auth']) ;


//----------------------- PEDIDOS--------------------------------

Route::middleware('auth:sanctum')->group(function () {
    // Cliente cria um novo pedido
    Route::post('/pedido', [PedidoController::class, 'store']);
    // Lista todos os pedidos
    Route::get('/pedidos', [PedidoController::class, 'indexPedido']);

    Route::get ('/meusPedidos/{idContratante}',[PedidoController::class , 'meusPedidos']);


});
Route::middleware('auth:sanctum')->get('/profissional/{idContratado}/pedidos', [PedidoController::class, 'pedidosPendentes']);






//  (aceitar ou recusar)



Route::get('/servicos', [ServicoController::class, 'servicoIndex']);


//---------------------------------------CHAT
Route::middleware('auth:sanctum')->group(function () {
    // Rota para criar ou obter uma sala de chat
    Route::post('/chat-room/{contactId}', [ChatController::class, 'createOrGetChatRoom']);

    // Rota para enviar mensagens
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);

    // Rota para obter as mensagens de uma sala de chat
    Route::get('/chat/messages/{roomId}', [ChatController::class, 'getMessages']);
});

// <Image source={Imagens.iconEnviar} style={styles.icon} />
