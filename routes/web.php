<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;
use App\Mail\QuotationRealizedMail;

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

// Route::get('/', fn () => redirect()->route('auth.login.index'));

Route::middleware('guest')->group(function () {
    Route::get('login', [Auth\LoginController::class, 'index'])->name('auth.login.index');
    Route::post('login', [Auth\LoginController::class, 'handle'])->name('auth.login.handle');

    Route::get('cadastro', [Auth\RegistrationController::class, 'index'])->name('auth.registration.index');
    Route::post('cadastro', [Auth\RegistrationController::class, 'handle'])->name('auth.registration.handle');

    Route::get('esqueceu-a-senha', [Auth\ForgotPasswordController::class, 'index'])->name('auth.forgot-password.index');
    Route::post('esqueceu-a-senha', [Auth\ForgotPasswordController::class, 'handle'])->name('auth.forgot-password.handle');

    Route::get('/redefinir-senha/{token}', [Auth\ForgotPasswordController::class, 'resetPasswordIndex'])->name('password.reset');
    Route::post('/redefinir-senha', [Auth\ForgotPasswordController::class, 'resetPasswordHandle'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/', Livewire\Dashboard::class)->name('dashboard');
    
    Route::middleware('isAdmin')->group(function () {
        Route::get('usuarios', Livewire\Users\Index::class)->name('users.index');
        Route::get('usuarios/editar/{user}', Livewire\Users\Edit::class)->name('users.edit');
        Route::get('usuarios/adicionar', Livewire\Users\Create::class)->name('users.create');
    });

    Route::get('sair', [Auth\LoginController::class, 'logout'])->name('auth.logout');
});