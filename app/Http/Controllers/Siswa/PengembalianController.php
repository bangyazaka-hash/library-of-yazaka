<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $anggota = Anggota::where('user_id', $user->id)->first();

        $pengembalian = collect();

        if ($anggota) {
            $pengembalian = Peminjaman::with('buku')
                ->where('anggota_id', $anggota->id)
                ->whereIn('status', ['dikembalikan', 'terlambat'])
                ->latest()
                ->paginate(10);
        }

        return view('siswa.pengembalian.index', compact('pengembalian'));
    }
}