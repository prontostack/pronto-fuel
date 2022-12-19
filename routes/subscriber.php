<?php

use App\Http\Controllers\Subscriber\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Subscriber Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your subscriber's area.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web", "auth" and "verify" middlewares and
| should work only under the app's public front domain.
|
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
