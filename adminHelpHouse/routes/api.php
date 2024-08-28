<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfissionalApiController;

use App\Http\Controllers\ContratanteController;




//contrataDO/profissional
Route::get('/pro' ,[ProfissionalApiController::class, 'indexApiPro']);
Route::post('/pro' ,[ProfissionalApiController::class, 'storeApiPro']);



Route::get('/cli' ,[ContratanteController::class, 'indexApi']);
Route::post('/clii' ,[ContratanteController::class, 'storeApi']) ;
 Route::post('/auth' ,[ContratanteController::class, 'auth']) ;


