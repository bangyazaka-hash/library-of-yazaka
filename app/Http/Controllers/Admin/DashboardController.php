<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBuku = Buku::count();
        $jumlahAnggota = Anggota::count();
        $jumlahDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $jumlahDikembalikan = Peminjaman::where('status', 'dikembalikan')->count();

        // DETEKSI TERLAMBAT
        $terlambat = Peminjaman::with('anggota.user', 'buku')
            ->where('status', 'dipinjam')
            ->whereDate('tanggal_jatuh_tempo', '<', Carbon::today())
            ->get();

        return view('admin.dashboard', compact(
            'jumlahBuku',
            'jumlahAnggota',
            'jumlahDipinjam',
            'jumlahDikembalikan',
            'terlambat' //kirim ke blade
        ));
    }
}