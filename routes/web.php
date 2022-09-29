<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Livewire;
use App\Http\Controllers\System as SystemControllers;
use App\Http\Livewire\System as SystemLivewire;
use App\Http\Livewire\Tenant as TenantLivewire;
use App\Http\Controllers\Tenant as TenantControllers;
use Livewire\Controllers\HttpConnectionHandler;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

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
        Route::get('painel', SystemLivewire\Dashboard::class)->name('admin.dashboard');
        Route::get('sair', [SystemControllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
    });
});

Route::group([
    'prefix' => '/{tenant}',
    'middleware' => [
        InitializeTenancyByPath::class,
    ]
], function () {
    Route::post('livewire/message/{name}', [HttpConnectionHandler::class, '__invoke']);
    Route::middleware('guest')->group(function () {
        Route::get('login', [TenantControllers\Auth\LoginController::class, 'index'])->name('login.index');
        Route::post('login', [TenantControllers\Auth\LoginController::class, 'handle'])->name('login.handle');

        // Route::get('cadastro', [TenantControllers\Auth\RegistrationController::class, 'index'])->name('auth.registration.index');
        // Route::post('cadastro', [TenantControllers\Auth\RegistrationController::class, 'handle'])->name('auth.registration.handle');

        Route::get('esqueceu-a-senha', [TenantControllers\Auth\ForgotPasswordController::class, 'index'])->name('forgot-password.index');
        Route::post('esqueceu-a-senha', [TenantControllers\Auth\ForgotPasswordController::class, 'handle'])->name('forgot-password.handle');

        Route::get('/redefinir-senha/{token}', [TenantControllers\Auth\ForgotPasswordController::class, 'resetPasswordIndex'])->name('password.reset');
        Route::post('/redefinir-senha', [TenantControllers\Auth\ForgotPasswordController::class, 'resetPasswordHandle'])->name('password.update');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', TenantLivewire\Dashboard::class)->name('dashboard');
        Route::get('configuracoes', TenantLivewire\Config::class)->name('config');

        Route::get('usuarios', TenantLivewire\Users\Index::class)->name('users.index');
        Route::get('usuarios/editar/{user}', TenantLivewire\Users\Edit::class)->name('users.edit');
        Route::get('usuarios/adicionar', TenantLivewire\Users\Create::class)->name('users.create');

        Route::get('membros', TenantLivewire\People\Index::class)->name('people.index');
        Route::get('membros/editar/{person}', TenantLivewire\People\Edit::class)->name('people.edit');
        Route::get('membros/adicionar', TenantLivewire\People\Create::class)->name('people.create');

        Route::get('cargos-eclesiasticos', TenantLivewire\EcclesiasticalRoles\Index::class)->name('ecclesiasticalRoles.index');
        Route::get('cargos-eclesiasticos/editar/{ecclesiasticalRole}', TenantLivewire\EcclesiasticalRoles\Edit::class)->name('ecclesiasticalRoles.edit');
        Route::get('cargos-eclesiasticos/adicionar', TenantLivewire\EcclesiasticalRoles\Create::class)->name('ecclesiasticalRoles.create');

        Route::get('lancamentos', TenantLivewire\FinancialTransactions\Index::class)->name('financialTransactions.index');
        Route::get('lancamentos/editar/{financialTransaction}', TenantLivewire\FinancialTransactions\Edit::class)->name('financialTransactions.edit');
        Route::get('lancamentos/adicionar', TenantLivewire\FinancialTransactions\Create::class)->name('financialTransactions.create');

        Route::get('sair', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    });
});
