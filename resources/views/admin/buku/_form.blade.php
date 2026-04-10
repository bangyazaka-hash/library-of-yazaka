<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Kode Buku</label>
        <input type="text" name="kode_buku" value="{{ old('kode_buku', isset($buku) ? $buku->kode_buku : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Contoh: BK001">
        @error('kode_buku')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Judul Buku</label>
        <input type="text" name="judul" value="{{ old('judul', isset($buku) ? $buku->judul : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Masukkan judul buku">
        @error('judul')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Penulis</label>
        <input type="text" name="penulis" value="{{ old('penulis', isset($buku) ? $buku->penulis : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Nama penulis">
        @error('penulis')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Penerbit</label>
        <input type="text" name="penerbit" value="{{ old('penerbit', isset($buku) ? $buku->penerbit : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Nama penerbit">
    </div>

    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', isset($buku) ? $buku->tahun_terbit : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Contoh: 2024">
        @error('tahun_terbit')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Kategori</label>
        <input type="text" name="kategori" value="{{ old('kategori', isset($buku) ? $buku->kategori : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Contoh: Novel / Pendidikan / Sains">
    </div>

    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Stok</label>
        <input type="number" name="stok" value="{{ old('stok', isset($buku) ? $buku->stok : 0) }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Jumlah stok">
        @error('stok')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Rak</label>
        <input type="text" name="rak" value="{{ old('rak', isset($buku) ? $buku->rak : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Contoh: Rak A1">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Deskripsi</label>
        <textarea name="deskripsi" rows="5"
            class="w-full rounded-2xl px-4 py-3 border outline-none resize-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8; color: #34495E;"
            placeholder="Masukkan deskripsi buku...">{{ old('deskripsi', isset($buku) ? $buku->deskripsi : '') }}</textarea>
    </div>
</div>