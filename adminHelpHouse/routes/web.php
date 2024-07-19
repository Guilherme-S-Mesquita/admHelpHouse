<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

Route::get('/admin/DashboardAdmin', [AdminController::class, 'index']);

Route::view('/login', 'login.form')->name('login.form');
Route::post('/auth', [LoginController::class,' auth'])->name('login.auth');
