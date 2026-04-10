<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Tampilkan daftar buku
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Buku::when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                      ->orWhere('kode_buku', 'like', "%{$search}%")
                      ->orWhere('penulis', 'like', "%{$search}%")
                      ->orWhere('kategori', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(8);

        return view('admin.buku.index', compact('buku', 'search'));
    }

    /**
     * Tampilkan form tambah buku
     */
    public function create()
    {
        return view('admin.buku.create');
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku',
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'kategori' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'rak' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
        ], [
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique' => 'Kode buku sudah digunakan.',
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
        ]);

        Buku::create([
            'kode_buku' => $request->kode_buku,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'rak' => $request->rak,
            'deskripsi' => $request->deskripsi,
            'status' => $request->stok > 0 ? 'tersedia' : 'habis',
        ]);

        return redirect()->route('admin.buku.index')->with('success', 'Data buku berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit buku
     */
    public function edit(Buku $buku)
    {
        return view('admin.buku.edit', compact('buku'));
    }

    /**
     * Update data buku
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $buku->id,
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'kategori' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'rak' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $buku->update([
            'kode_buku' => $request->kode_buku,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'rak' => $request->rak,
            'deskripsi' => $request->deskripsi,
            'status' => $request->stok > 0 ? 'tersedia' : 'habis',
        ]);

        return redirect()->route('admin.buku.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Hapus buku
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Data buku berhasil dihapus.');
    }
}