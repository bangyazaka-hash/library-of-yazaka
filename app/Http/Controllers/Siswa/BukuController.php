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
        $rak = $request->rak; // 🔥 TAMBAHAN FILTER

        $buku = Buku::when($search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%")
                      ->orWhere('penulis', 'like', "%{$search}%")
                      ->orWhere('penerbit', 'like', "%{$search}%");
            })
            ->when($rak, function ($query, $rak) {
                $query->where('rak', $rak);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // 🔥 biar filter tidak hilang

        return view('siswa.buku.index', compact('buku'));
    }

    public function pinjam(Buku $buku)
    {
        $user = Auth::user();
        $anggota = Anggota::where('user_id', $user->id)->first();

        // ❌ kalau anggota tidak ada
        if (!$anggota) {
            return back()->with('error', 'Data anggota tidak ditemukan.');
        }

        // ❌ stok habis
        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // ❌ CEGAH PINJAM BUKU YANG SAMA
        $cek = Peminjaman::where('anggota_id', $anggota->id)
            ->where('buku_id', $buku->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($cek) {
            return back()->with('error', 'Kamu sudah meminjam buku ini.');
        }

        // ✅ GENERATE KODE AMAN (ANTI DUPLIKAT)
        $last = Peminjaman::latest()->first();

        $number = $last 
            ? ((int) substr($last->kode_peminjaman, 3)) + 1 
            : 1;

        $kode = 'PMJ' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // ✅ SIMPAN
        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $buku->id,
            'kode_peminjaman' => $kode,
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(7),
            'status' => 'dipinjam',
        ]);

        // ✅ kurangi stok
        $buku->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam.');
    }
}