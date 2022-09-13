<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Livewire\Tenant as Livewire;
use App\Http\Controllers\Tenant as Controllers;


/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [Controllers\Auth\LoginController::class, 'index'])->name('login.index');
        Route::post('login', [Controllers\Auth\LoginController::class, 'handle'])->name('login.handle');
    
        Route::get('cadastro', [Controllers\Auth\RegistrationController::class, 'index'])->name('auth.registration.index');
        Route::post('cadastro', [Controllers\Auth\RegistrationController::class, 'handle'])->name('auth.registration.handle');
    
        Route::get('esqueceu-a-senha', [Controllers\Auth\ForgotPasswordController::class, 'index'])->name('forgot-password.index');
        Route::post('esqueceu-a-senha', [Controllers\Auth\ForgotPasswordController::class, 'handle'])->name('forgot-password.handle');
    
        Route::get('/redefinir-senha/{token}', [Controllers\Auth\ForgotPasswordController::class, 'resetPasswordIndex'])->name('password.reset');
        Route::post('/redefinir-senha', [Controllers\Auth\ForgotPasswordController::class, 'resetPasswordHandle'])->name('password.update');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', Livewire\Dashboard::class)->name('dashboard');
    
        Route::get('usuarios', Livewire\Users\Index::class)->name('users.index');
        Route::get('usuarios/editar/{user}', Livewire\Users\Edit::class)->name('users.edit');
        Route::get('usuarios/adicionar', Livewire\Users\Create::class)->name('users.create');
    
        Route::get('sair', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    });
});
