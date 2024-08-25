<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfissionalApiController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ContratanteController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//contrataDO/profissional
Route::get('/pro' ,[ProfissionalApiController::class, 'indexApiPro']);
Route::post('/pro' ,[ProfissionalApiController::class, 'storeApiPro']);

Route::get('/endereco' ,[EnderecoController::class, 'indexApi']);
Route::post('/endereco' ,[EnderecoController::class, 'storeApiEndereco']);

Route::get('/cli' ,[ContratanteController::class, 'indexApi']);
Route::post('/clii' ,[ContratanteController::class, 'storeApi']) ;

