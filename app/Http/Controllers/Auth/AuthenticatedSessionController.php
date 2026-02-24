<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $role = 'customer';

        if ($request->is('admin/login')) {
            $role = 'admin';
        } elseif ($request->is('petugas/login')) {
            $role = 'petugas';
        }

        return view('auth.login', compact('role'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        // Cek URL login
        if ($request->is('admin/login')) {

            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda bukan admin.'
                ]);
            }

            return redirect()->intended('/admin/dashboard');
        }

        if ($request->is('petugas/login')) {

            if ($user->role !== 'petugas') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda bukan petugas.'
                ]);
            }

            return redirect()->intended('/petugas/dashboard');
        }

        // Default customer
        return redirect()->intended(route('dashboard'));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
