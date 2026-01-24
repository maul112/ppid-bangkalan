<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input termasuk NIK dan Foto KTP
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik'], // NIK harus 16 digit dan unik
            'foto_ktp' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Maksimal 2MB
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Proses Upload File KTP
        $pathKtp = null;
        if ($request->hasFile('foto_ktp')) {
            // File akan disimpan di folder: storage/app/public/ktp_files
            $pathKtp = $request->file('foto_ktp')->store('ktp_files', 'public');
        }

        // 3. Simpan data ke Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'foto_ktp' => $pathKtp, // Menyimpan path/alamat filenya saja
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}