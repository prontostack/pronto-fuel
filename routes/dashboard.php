<?php

use App\Http\Controllers\Dashboard\Account\TwoFactorAuthController;
use App\Http\Controllers\Dashboard\Account\PasswordController;
use App\Http\Controllers\Dashboard\Account\AccountController;
use App\Http\Controllers\Dashboard\Account\ProfileController;
use App\Http\Controllers\Dashboard\OverviewController;
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

Route::prefix('account')->name('account')->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('.profile');

    Route::put('/password', [PasswordController::class, 'update'])
        ->name('.password');

    Route::get('/', [AccountController::class, 'index'])
        ->name('');
});
