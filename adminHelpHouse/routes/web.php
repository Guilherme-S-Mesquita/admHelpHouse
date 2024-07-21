<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicoController;

Route::get('/admin/DashboardAdmin', [AdminController::class, 'index'])->name('admin');

//todas as rotas para o login funcionar
Route::get('/login',[LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.logout');


Route::get('add/servico', [ServicoController::class, 'servico'])->name('add.servico');

