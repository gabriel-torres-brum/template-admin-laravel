<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Tenant as Livewire;
use App\Http\Controllers\Tenant as Controllers;
use Livewire\Controllers\HttpConnectionHandler;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

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

// Route::fallback(fn () => redirect(tenantRoute('login.index')));


