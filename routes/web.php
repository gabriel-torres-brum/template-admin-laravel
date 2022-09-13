<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System as Controllers;
use App\Http\Livewire\System as Livewire;

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

// Route::get('/', fn () => redirect()->route('login.index'));

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [Controllers\Auth\LoginController::class, 'index'])->name('admin.login.index');
        Route::post('login', [Controllers\Auth\LoginController::class, 'handle'])->name('admin.login.handle');
    });
    
    Route::middleware('auth')->group(function () {
        Route::get('/painel', Livewire\Dashboard::class)->name('admin.dashboard');
        Route::get('sair', [Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
    });
});
