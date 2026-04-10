<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $anggota = Anggota::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where('nis', 'like', "%{$search}%")
                    ->orWhere('kelas', 'like', "%{$search}%")
                    ->orWhere('no_anggota', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                          ->orWhere('username', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(8);

        return view('admin.anggota.index', compact('anggota', 'search'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'nis' => 'required|string|max:50|unique:anggota,nis',
            'kelas' => 'nullable|string|max:50',
            'jenis_kelamin' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        // Simpan akun user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        // Generate nomor anggota otomatis
        $lastAnggota = Anggota::latest()->first();
        $lastNumber = 0;

        if ($lastAnggota && $lastAnggota->no_anggota) {
            $lastNumber = (int) substr($lastAnggota->no_anggota, 3);
        }

        $newNoAnggota = 'AGT' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Simpan data anggota
        Anggota::create([
            'user_id' => $user->id,
            'no_anggota' => $newNoAnggota,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        $anggota->load('user');
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $anggota->user_id,
            'password' => 'nullable|string|min:6|confirmed',
            'nis' => 'required|string|max:50|unique:anggota,nis,' . $anggota->id,
            'kelas' => 'nullable|string|max:50',
            'jenis_kelamin' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $anggota->user->update($userData);

        $anggota->update([
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->user()->delete(); // otomatis anggota ikut kehapus karena cascade
        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}