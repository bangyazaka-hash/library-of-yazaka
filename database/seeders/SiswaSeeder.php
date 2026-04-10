<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Anggota;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = User::updateOrCreate(
            ['username' => 'siswa1'],
            [
                'name' => 'Siswa Demo',
                'email' => 'siswa1@perpus.com',
                'password' => 'siswa123',
                'role' => 'siswa',
                'status' => 'aktif',
            ]
        );

        Anggota::updateOrCreate(
            ['user_id' => $siswa->id],
            [
                'no_anggota' => 'AGT001',
                'nis' => '123456789',
                'kelas' => 'XII RPL 1',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'alamat' => 'Banjar, Jawa Barat',
                'no_hp' => '081234567890',
                'tanggal_daftar' => now()->toDateString(),
            ]
        );
    }
}