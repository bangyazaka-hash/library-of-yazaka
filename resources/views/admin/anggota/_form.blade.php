<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Nama -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Nama Lengkap</label>
        <input type="text" name="name"
            value="{{ old('name', isset($anggota) ? $anggota->user->name : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Masukkan nama lengkap">
        @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Username -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Username</label>
        <input type="text" name="username"
            value="{{ old('username', isset($anggota) ? $anggota->user->username : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Masukkan username login">
        @error('username')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">
            Password {{ isset($anggota) ? '(Kosongkan jika tidak diubah)' : '' }}
        </label>
        <input type="password" name="password"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Masukkan password">
        @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Konfirmasi Password -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Ulangi password">
    </div>

    <!-- NIS -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">NIS</label>
        <input type="text" name="nis"
            value="{{ old('nis', isset($anggota) ? $anggota->nis : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Masukkan NIS">
        @error('nis')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Kelas -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Kelas</label>
        <input type="text" name="kelas"
            value="{{ old('kelas', isset($anggota) ? $anggota->kelas : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Contoh: XII RPL 1">
    </div>

    <!-- Jenis Kelamin -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Jenis Kelamin</label>
        <select name="jenis_kelamin"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki" {{ old('jenis_kelamin', isset($anggota) ? $anggota->jenis_kelamin : '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', isset($anggota) ? $anggota->jenis_kelamin : '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <!-- No HP -->
    <div>
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">No HP</label>
        <input type="text" name="no_hp"
            value="{{ old('no_hp', isset($anggota) ? $anggota->no_hp : '') }}"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Masukkan nomor HP">
    </div>

    <!-- Status -->
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Status</label>
        <select name="status"
            class="w-full rounded-2xl px-4 py-3 border outline-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;">
            <option value="aktif" {{ old('status', isset($anggota) ? $anggota->status : '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ old('status', isset($anggota) ? $anggota->status : '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    <!-- Alamat -->
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-2" style="color: #34495E;">Alamat</label>
        <textarea name="alamat" rows="4"
            class="w-full rounded-2xl px-4 py-3 border outline-none resize-none"
            style="background-color: #FDFBF7; border-color: #e8e2d8;"
            placeholder="Masukkan alamat lengkap">{{ old('alamat', isset($anggota) ? $anggota->alamat : '') }}</textarea>
    </div>
</div>