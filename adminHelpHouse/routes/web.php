<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicoController;

Route::get('/admin/DashboardAdmin', [AdminController::class, 'index']);

//todas as rotas para o login funcionar
Route::controller(LoginController::class)->group(function (){
Route::view('/', 'index')->name('login.index');
Route::post('/login', 'store')->name('login.store');
Route::get('/logout', 'destroy')->name('login.logout');
});

Route::get('add/servico', [ServicoController::class, 'servico'])->name('add.servico');

