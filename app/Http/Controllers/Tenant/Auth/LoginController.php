<?php

namespace App\Http\Controllers\Tenant\Auth;

use App\Http\Controllers\Controller;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('tenant.auth.login');
    }

    public function handle(Request $request): \Illuminate\Routing\Redirector | \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Fazer auditoria

        if (auth()->attempt($credentials)) {
            return redirect()
                ->intended(tenantRoute('dashboard'));
        }

        Notification::make()
            ->title("Email ou senha inválidos.")
            ->danger()
            ->send();

        return back()
            ->withErrors(['error' => 'Email ou senha inválidos.']);
    }

    public function logout(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        session()->flush();
        auth()->logout();

        Notification::make()
            ->success()
            ->title("Sessão encerrada.")
            ->send();

        return redirect(tenantRoute('login.index'));
    }
}
