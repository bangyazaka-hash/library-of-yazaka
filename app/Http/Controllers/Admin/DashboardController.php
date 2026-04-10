<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBuku = Buku::count();
        $jumlahAnggota = Anggota::count();
        $jumlahDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $jumlahDikembalikan = Peminjaman::where('status', 'dikembalikan')->count();

        return view('admin.dashboard', compact(
            'jumlahBuku',
            'jumlahAnggota',
            'jumlahDipinjam',
            'jumlahDikembalikan'
        ));
    }
}