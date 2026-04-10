<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $anggota = Auth::user()->anggota;

        $jumlahBuku = Buku::count();
        $jumlahDipinjam = 0;
        $jumlahDikembalikan = 0;

        if ($anggota) {
            $jumlahDipinjam = Peminjaman::where('anggota_id', $anggota->id)
                ->where('status', 'dipinjam')
                ->count();

            $jumlahDikembalikan = Peminjaman::where('anggota_id', $anggota->id)
                ->where('status', 'dikembalikan')
                ->count();
        }

        return view('siswa.dashboard', compact(
            'jumlahBuku',
            'jumlahDipinjam',
            'jumlahDikembalikan'
        ));
    }
}