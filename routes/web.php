<?php

use App\Http\Controllers\DomainAliasController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\DomainDkimController;
use App\Http\Controllers\DomainUserAliasController;
use App\Http\Controllers\DomainUserController;
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
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('domain', DomainController::class)
    ->except(['create', 'edit', 'show'])
    ->middleware(['auth', 'verified']);

Route::resource('domain-user', DomainUserController::class)
    ->except(['create', 'edit', 'show'])
    ->middleware(['auth', 'verified']);

Route::resource('domain-alias', DomainAliasController::class)
    ->except(['create', 'edit', 'show'])
    ->middleware(['auth', 'verified']);

Route::resource('domain-user-alias', DomainUserAliasController::class)
    ->except(['create', 'edit', 'show'])
    ->middleware(['auth', 'verified']);

Route::resource('domain-dkim', DomainDkimController::class)
    ->except(['create', 'edit', 'show'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
