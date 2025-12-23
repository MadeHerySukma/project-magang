<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Coba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Cek role user dan redirect sesuai role
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect('/')->with('success', 'Selamat datang Admin!');
            } else {
                return redirect('/')->with('success', 'Selamat datang! ' . auth()->user()->name);
            }
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register (khusus pelanggan) - REDIRECT KE LOGIN
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|min:10|max:15|regex:/^[0-9]+$/', // ← TAMBAHAN BARU
            'password' => 'required|min:6|confirmed',
        ],
        [
            // Custom error messages
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain',
            // ============================================
            // TAMBAHAN BARU: Error messages untuk no_hp
            // ============================================
            'no_hp.required' => 'Nomor HP/WhatsApp wajib diisi',
            'no_hp.min' => 'Nomor HP minimal 10 digit',
            'no_hp.max' => 'Nomor HP maksimal 15 digit',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka',
            // ============================================
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);
        
        // Buat user baru dengan role pelanggan
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp, // ← TAMBAHAN BARU
            'password' => Hash::make($request->password),
            'role' => 'pelanggan',
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil');
    }
}