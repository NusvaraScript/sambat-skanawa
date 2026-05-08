<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        // Petugas/admin login
        if (Auth::guard('petugas')->attempt($validated, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // Siswa login (remember me tidak dipakai karena tabel siswa tidak punya kolom remember_token)
        if (Auth::guard('siswa')->attempt($validated, false)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()
            ->withErrors(['username' => 'Username atau password tidak sesuai.'])
            ->onlyInput('username');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nis' => ['required', 'integer', 'unique:siswa,nis'],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:siswa,username'],
            'kelas' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'integer'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $siswa = Siswa::create([
            'nis' => $validated['nis'],
            'nama_siswa' => $validated['nama_siswa'],
            'username' => $validated['username'],
            'kelas' => $validated['kelas'],
            'no_hp' => $validated['no_hp'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('siswa')->login($siswa);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request): RedirectResponse
    {
        // Logout dari dua guard yang mungkin aktif.
        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
        }

        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
