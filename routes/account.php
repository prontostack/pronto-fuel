<?php

use App\Http\Controllers\Account\PasswordController;
use App\Http\Controllers\Account\PreferencesController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\SecurityController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile');

Route::put('/profile', [ProfileController::class, 'update']);

Route::get('/security', [SecurityController::class, 'edit'])
    ->name('security');

Route::put('/password', [PasswordController::class, 'update'])
    ->name('password');

Route::get('/preferences', [PreferencesController::class, 'edit'])
    ->name('preferences');
