<?php

use App\Http\Controllers\PedidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfissionalApiController;
use App\Http\Controllers\ContratanteController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\PusherAuthController;


// -------------------------------------- Rotas de Profissional --------------------------------------
Route::get('/pro', [ProfissionalApiController::class, 'indexApiPro']);
Route::get('/pro/{id}', [ProfissionalApiController::class, 'showApi']);
Route::post('/proo', [ProfissionalApiController::class, 'storeApiPro']);
Route::post('/authpro', [ProfissionalApiController::class, 'authPro']);

// Buscar dados do Profissional
Route::middleware('auth:sanctum')->get('/perfilPro', [ProfissionalApiController::class, 'dadosProfissionais']);
Route::middleware('auth:sanctum')->get('/profissional/{idContratado}/dadosProfissionais', [ProfissionalApiController::class, 'dadosProfissionais']);

// -------------------------------------- Rotas de Contratante --------------------------------------
Route::get('/cli', [ContratanteController::class, 'indexApi']);
Route::get('/cli/{id}', [ContratanteController::class, 'showApi']);
Route::post('/clii', [ContratanteController::class, 'storeApi']);
Route::post('/auth', [ContratanteController::class, 'auth']);

// -------------------------------------- Rotas de Pedidos ------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pedido', [PedidoController::class, 'store']);  // Criar pedido
    Route::get('/pedidos', [PedidoController::class, 'indexPedido']);  // Listar pedidos
    Route::get('/meusPedidos/{idContratante}', [PedidoController::class, 'meusPedidos']);  // Pedidos do contratante
    Route::get('/profissional/{idContratado}/pedidos', [PedidoController::class, 'pedidosPendentes']);  // Pedidos do profissional
});

// -------------------------------------- Rotas de Serviços ------------------------------------------
Route::get('/servicos', [ServicoController::class, 'servicoIndex']);

// -------------------------------------- Rotas de Chat ---------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/chat-room/{contactId}', [ChatController::class, 'createOrGetChatRoom']);  // Criar ou obter sala de chat
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);  // Enviar mensagem
    Route::get('/chat/messages/{roomId}', [ChatController::class, 'getMessages']);  // Obter mensagens da sala de chat
});

Route::post('/pusher/auth', [PusherAuthController::class, 'authenticate']);
