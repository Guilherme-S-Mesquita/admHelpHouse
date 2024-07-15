<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



Route::get('/admin/DashboardAdmin', [AdminController::class, 'admin']);
