<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Anggota;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->status !== 'aktif') {
                Auth::logout();
                return back()->with('error', 'Akun Anda tidak aktif.');
            }

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Login admin berhasil.');
            }

            if (Auth::user()->role === 'siswa') {
                return redirect()->route('siswa.dashboard')
                    ->with('success', 'Login siswa berhasil.');
            }
        }

        return back()->with('error', 'Username atau password salah.')
                     ->withInput();
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register (FIXED 🔥)
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        DB::beginTransaction();

        try {
            // 1. Buat user
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
                'status' => 'aktif',
            ]);

            // 2. 🔥 WAJIB: Buat anggota (biar muncul di admin)
            Anggota::create([
                'user_id' => $user->id,
                'no_anggota' => 'AGT' . rand(100, 999),
                'nis' => rand(100000, 999999),
                'kelas' => 'Belum diisi',
                'jenis_kelamin' => '-',
                'alamat' => '-',
                'no_hp' => '-',
                'status' => 'aktif',
            ]);

            DB::commit();

            // auto login
            Auth::login($user);

            return redirect()->route('siswa.dashboard')
                ->with('success', 'Registrasi berhasil, selamat datang!');

        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}