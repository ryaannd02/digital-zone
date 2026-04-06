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
        // hanya untuk tampilan (judul login)
        $role = $request->query('role', 'customer');

        return view('auth.login', compact('role'));
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(Request $request): RedirectResponse
{
    $credentials = $request->only('email', 'password');
    $loginRole = $request->input('role'); // 🔥 dari form

    $user = \App\Models\User::where('email', $credentials['email'])->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'Email tidak ditemukan'
        ]);
    }

    // 🔥 VALIDASI ROLE
    if ($user->role !== $loginRole) {
        return back()->withErrors([
            'email' => 'Akun tidak sesuai dengan halaman login'
        ]);
    }

    // 🔥 LOGIN
    if (!Auth::attempt($credentials)) {
        return back()->withErrors([
            'email' => 'Password salah'
        ]);
    }

    $request->session()->regenerate();

    // 🔥 REDIRECT
    return match ($user->role) {
        'admin' => redirect('/admin/dashboard'),
        'petugas' => redirect('/petugas/dashboard'),
        default => redirect()->route('dashboard'),
    };
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