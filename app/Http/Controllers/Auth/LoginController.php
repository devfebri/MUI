<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Fallback — tidak digunakan karena sendLoginResponse di-override.
     */
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override sendLoginResponse agar redirect SELALU berdasarkan role,
     * bukan dari url.intended yang tersimpan di session (penyebab double-prefix).
     */
    protected function sendLoginResponse(Request $request): mixed
    {
        // Hapus intended URL dari session agar tidak dipakai redirect
        $request->session()->forget('url.intended');
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = $this->guard()->user();

        return match ($user->role) {
            'admin' => redirect(route('admin.dashboard')),
            'operator' => redirect(route('operator.dashboard')),
            default => redirect('/'),
        };
    }

    /**
     * Logout: hapus sesi lalu redirect ke login.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
