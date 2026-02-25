<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses autentikasi (Login).
     */
    public function authenticate(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Login (dengan fitur 'Remember Me' jika diinginkan)
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // 3. Regenerasi session untuk mencegah Session Fixation
            $request->session()->regenerate();

            // 4. Redirect ke dashboard admin (atau halaman yang dituju sebelumnya)
            return redirect()->intended(route('admin.dashboard'))
                             ->with('success', 'Selamat datang kembali, Admin!');
        }

        // 5. Jika gagal, kembalikan dengan pesan error
        throw ValidationException::withMessages([
            'email' => ['Kredensial yang Anda berikan tidak cocok dengan data kami.'],
        ]);
    }

    /**
     * Menangani proses Logout.
     */
    public function logout(Request $request)
    {
        // 1. Logout dari Guard
        Auth::logout();

        // 2. Hapus Session
        $request->session()->invalidate();

        // 3. Resetting CSRF Token
        $request->session()->regenerateToken();

        // 4. Redirect ke halaman awal (Dashboard Pengunjung)
        return redirect()->route('visitor.dashboard')
                         ->with('info', 'Anda telah berhasil keluar.');
    }
}
