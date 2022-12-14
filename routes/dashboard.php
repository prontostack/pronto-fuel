<?php

use App\Http\Controllers\Dashboard\OverviewController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application's dashboard.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web", "auth" and "verify" middlewares.
|
*/

Route::get('/dashboard', [OverviewController::class, 'index'])->name('dashboard');
