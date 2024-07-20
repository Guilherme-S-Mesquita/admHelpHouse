<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicoController;

Route::get('/admin/DashboardAdmin', [AdminController::class, 'index']);

Route::view('/login', 'login.form')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

 Route::get('add/servico', [ServicoController::class, 'servico'])->name('add.servico');

