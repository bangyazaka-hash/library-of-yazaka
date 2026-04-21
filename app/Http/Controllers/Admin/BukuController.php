<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * Simpan buku baru (SUDAH ADA GAMBAR)
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ VALIDASI GAMBAR
        ], [
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique' => 'Kode buku sudah digunakan.',
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
        ]);

        $data = $request->all();

        // ✅ UPLOAD GAMBAR
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $data['status'] = $request->stok > 0 ? 'tersedia' : 'habis';

        Buku::create($data);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit buku
     */
    public function edit(Buku $buku)
    {
        return view('admin.buku.edit', compact('buku'));
    }

    /**
     * Update data buku (SUDAH SUPPORT UPDATE GAMBAR)
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // ✅ JIKA ADA GAMBAR BARU
        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $data['status'] = $request->stok > 0 ? 'tersedia' : 'habis';

        $buku->update($data);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Hapus buku
     */
    public function destroy(Buku $buku)
    {
        // ✅ HAPUS GAMBAR JUGA
        if ($buku->gambar) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}