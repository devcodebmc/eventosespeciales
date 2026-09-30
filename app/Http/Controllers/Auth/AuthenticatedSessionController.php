<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): \Illuminate\View\View
    {
        return view('auth.login', [
            'canResetPassword' => Route::has('password.request'),
            'status'           => session('status'),
            'prefill_email'    => session()->pull('prefill_email'),    // pull = get + forget
            'prefill_password' => session()->pull('prefill_password'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }

    public function createWithToken($token)
    {
        $user = \App\Models\User::where('autologin_token', $token)->first();

        if (!$user) {
            abort(403);
        }

        session([
            'prefill_email'    => $user->email,
            'prefill_password' => $user->autologin_password,
        ]);

        return redirect()->route('login');
    }
}
