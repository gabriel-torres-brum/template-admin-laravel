<?php

namespace App\Http\Controllers\System\Auth;

use App\Http\Controllers\Controller;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('system.auth.login');
    }

    public function handle(Request $request): \Illuminate\Routing\Redirector | \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Fazer auditoria (admin)

        if (auth()->attempt($credentials)) {
            return redirect()
                ->intended(route('admin.dashboard'));
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
        auth()->logout();

        Notification::make()
            ->success()
            ->title("Sessão encerrada.")
            ->send();

        return redirect()->route('admin.login.index');
    }
}

