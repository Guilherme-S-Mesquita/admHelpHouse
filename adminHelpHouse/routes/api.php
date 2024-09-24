<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfissionalApiController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContratanteController;
use App\Livewire\Auth;
use App\Livewire\Contact;
use App\Livewire\RealtimeMessage;





//contrataDO/profissional
Route::get('/pro' ,[ProfissionalApiController::class, 'indexApiPro']);
Route::post('/proo' ,[ProfissionalApiController::class, 'storeApiPro']);
Route::post('/authpro' ,[ProfissionalApiController::class, 'authPro']);


// ´------------------------CONTRATANTE API
Route::get('/cli' ,[ContratanteController::class, 'indexApi']);
Route::get('/cli/{id}' ,[ContratanteController::class, 'showApi']);
Route::post('/clii' ,[ContratanteController::class, 'storeApi']) ;
Route::post('/auth' ,[ContratanteController::class, 'auth']) ;


Route::middleware('auth')->group(function () {
    Route::get('/chats', [ChatController::class, 'index']);
    Route::get('/chats/{roomId}', [Contact::class, 'getMessages']);
    Route::post('/chats/send', [RealtimeMessage::class, 'sendMessage']);
});
