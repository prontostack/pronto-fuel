<?php

use App\Http\Controllers\Dashboard\Account\PasswordController;
use App\Http\Controllers\Dashboard\Account\PreferencesController;
use App\Http\Controllers\Dashboard\Account\ProfileController;
use App\Http\Controllers\Dashboard\Account\SecurityController;
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

Route::prefix('account')->name('account')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('.profile');

    Route::put('/profile', [ProfileController::class, 'update']);

    Route::get('/security', [SecurityController::class, 'edit'])
        ->name('.security');

    Route::put('/password', [PasswordController::class, 'update'])
        ->name('.password');

    Route::get('/preferences', [PreferencesController::class, 'edit'])
        ->name('.preferences');
});

Route::resources([
    'posts' => PostController::class
]);
