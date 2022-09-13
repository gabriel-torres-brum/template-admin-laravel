<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Livewire;
use App\Http\Controllers\System as SystemControllers;
use App\Http\Livewire\System as SystemLivewire;

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

Route::get('/', Livewire\Index::class)->name('index');

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [SystemControllers\Auth\LoginController::class, 'index'])->name('admin.login.index');
        Route::post('login', [SystemControllers\Auth\LoginController::class, 'handle'])->name('admin.login.handle');
    });
    
    Route::middleware('auth')->group(function () {
        Route::get('/painel', SystemLivewire\Dashboard::class)->name('admin.dashboard');
        Route::get('sair', [SystemControllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
    });
});
