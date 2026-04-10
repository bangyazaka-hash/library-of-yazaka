<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('anggota.user', 'buku')
            ->latest()
            ->paginate(8);

        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Form tambah peminjaman
     */
    public function create()
    {
        $anggota = Anggota::with('user')
            ->where('status', 'aktif')
            ->get();

        $buku = Buku::where('stok', '>', 0)->get();

        return view('admin.peminjaman.create', compact('anggota', 'buku'));
    }

    /**
     * Simpan peminjaman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ], [
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'buku_id.required' => 'Buku wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_jatuh_tempo.required' => 'Tanggal jatuh tempo wajib diisi.',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis.');
        }

        $last = Peminjaman::latest()->first();
        $number = 0;

        if ($last && $last->kode_peminjaman) {
            $number = (int) substr($last->kode_peminjaman, 3);
        }

        $kode = 'PMJ' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);

        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'kode_peminjaman' => $kode,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'dipinjam',
            'denda' => 0,
        ]);

        // Kurangi stok buku
        $buku->decrement('stok');

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    /**
     * Proses pengembalian buku
     */
    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan' || $peminjaman->status === 'terlambat') {
            return redirect()->route('admin.peminjaman.index')
                ->with('error', 'Buku ini sudah dikembalikan.');
        }

        $today = Carbon::today();
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);

        $denda = 0;
        $status = 'dikembalikan';

        if ($today->greaterThan($jatuhTempo)) {
            $hariTerlambat = $jatuhTempo->diffInDays($today);
            $denda = $hariTerlambat * 1000; // denda Rp1.000/hari
            $status = 'terlambat';
        }

        $peminjaman->update([
            'tanggal_kembali' => $today->format('Y-m-d'),
            'status' => $status,
            'denda' => $denda,
        ]);

        // Tambahkan stok buku lagi
        $peminjaman->buku->increment('stok');

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }

    /**
     * Hapus data peminjaman
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // Jika masih dipinjam, balikin stok dulu
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}