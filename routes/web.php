<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'title' => 'Dashboard'
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/account', function () {
    return Inertia::render('Account', [
        'title' => 'My Account'
    ]);
})->middleware(['auth', 'verified'])->name('account.index');

Route::post('/notify/{type}', function ($type) {
    return back()->toast('This notification comes from the server side =)', $type);
});

Route::get('/dialog/{type}/{position?}', function ($type, $position = null) {
    $page = [
        'modal' => 'WelcomeModal',
        'slideover' => 'WelcomeSlideOver'
    ][$type];

    return Inertia::modal($page)
        ->with([
            'title' => 'One modal to rule them all!',
            'message' => 'That\'s right! I\'m a modal coming from the far, far away kingdom of the Server...',
            'position' => $position
        ])
        ->baseRoute('welcome');
});
