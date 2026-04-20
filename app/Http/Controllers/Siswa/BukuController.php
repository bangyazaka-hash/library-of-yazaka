<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Buku::when($search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%")
                      ->orWhere('penulis', 'like', "%{$search}%")
                      ->orWhere('penerbit', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // 🔥 biar search tidak hilang saat pagination

        return view('siswa.buku.index', compact('buku'));
    }

    public function pinjam(Buku $buku)
    {
        $user = Auth::user();
        $anggota = Anggota::where('user_id', $user->id)->first();

        if (!$anggota) {
            return back()->with('error', 'Data anggota tidak ditemukan.');
        }

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // 🔥 kode otomatis
        $kode = 'PMJ' . str_pad(Peminjaman::count() + 1, 3, '0', STR_PAD_LEFT);

        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $buku->id,
            'kode_peminjaman' => $kode,
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(7),
            'status' => 'dipinjam',
        ]);

        // kurangi stok
        $buku->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam.');
    }
}