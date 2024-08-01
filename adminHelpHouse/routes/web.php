<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UsersController;


// rota principal a dashboard
Route::get('/admin/DashboardAdmin', [AdminController::class, 'index'])->name('dashboard');

//todas as rotas para o login funcionar
Route::get('/',[loginController::class, 'index'])->name('login.index');
Route::post('/',[loginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('login.logout');
// Rotas cadastro login
Route::get('/login/register',[loginController::class, 'register'])->name('login.register');
Route::post('/login/auth',[loginController::class, 'authenticate'])->name('login.auth');
Route::post('/login/processo-registro',[loginController::class, 'processoDeRegistro'])->name('login.processoDeRegistro');





// -------------------------------ADD SERVICO----------------------------------------
Route::get('add/servico',[ ServicoController::class ,'servico'])->name('add.servico');
Route::get('/editServico/{idServicos}', [ServicoController::class, 'edit'])->name('edit.servico');
Route::put('/editServico/{idServicos}', [ServicoController::class, 'update'])->name('update.servico');
Route::delete('/editServico/{idServicos}', [ServicoController::class, 'destroy'])->name('delete.servico');

//-------------------------------- CRIAR SERVICO---------------------------------------
Route::get('/criarServico',[ServicoController::class, 'create'])->name('criar.servico');
Route::post('/adicionar',[ServicoController::class, 'store']);

//--------------------------------- USUARIOS -------------------------------------------
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
// --------------------------------USUARIOS PAGINA ADM----------------------------------
Route::get('/adm' ,[UsersController::class, 'userAdm']) ->name('users.admins');
Route::get('/editadmin/{id}' ,[UsersController::class, 'edit']) ->name('edit.admins');
Route::put('/editadmin/{id}' ,[UsersController::class, 'update']) ->name('update.admins');
Route::delete('/editadmin/{id}' ,[UsersController::class, 'delete']) ->name('delete.admins');







