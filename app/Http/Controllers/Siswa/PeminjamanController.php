<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $anggota = Anggota::where('user_id', $user->id)->first();

        $peminjaman = collect();

        if ($anggota) {
            $peminjaman = Peminjaman::with('buku')
                ->where('anggota_id', $anggota->id)
                ->where('status', 'dipinjam')
                ->latest()
                ->paginate(10);
        }

        return view('siswa.peminjaman.index', compact('peminjaman'));
    }
}