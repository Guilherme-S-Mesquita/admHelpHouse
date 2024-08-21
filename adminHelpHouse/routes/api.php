<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServicoController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/retorno', [ServicoController::class, 'indexApi']);
// Route::get('/retorno','App\Http\Controllers\ServicoController@indexapi');
