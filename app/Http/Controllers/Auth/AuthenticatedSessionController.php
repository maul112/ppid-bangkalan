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
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        // $request->session()->regenerate();
        
        $user = $request->user();
        
        // if ($user->role === 'admin_ppid' || $user->role === 'admin') {
        //     return redirect()->intended(route('admin.dashboard'));
        // }
        // 1. Logika untuk Admin PPID
        if (!$user->opd_id && $user->role === 'admin_ppid') {
            return redirect()->intended(route('admin.dashboard'));
        }

        // 2. Logika untuk Admin OPD
        if ($user->opd_id && $user->role === 'admin_opd') {
            return redirect()->intended(route('admin.opd.dashboard'));
        }

        // 3. JIKA USER BIASA: Paksa Logout dan Tolak Akses
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('error', 'Akses Ditolak: Halaman ini hanya untuk Pengelola (Admin).');
    }

    public function destroy(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Ganti '/' dengan route beranda publik Anda (misal: 'home')
    return redirect('/'); 
}
}