<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            // Tanggal kembali
            if (!Schema::hasColumn('peminjaman', 'tanggal_kembali')) {
                $table->date('tanggal_kembali')->nullable()->after('tanggal_jatuh_tempo');
            }

            // Denda
            if (!Schema::hasColumn('peminjaman', 'denda')) {
                $table->integer('denda')->default(0)->after('tanggal_kembali');
            }

        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {

            if (Schema::hasColumn('peminjaman', 'tanggal_kembali')) {
                $table->dropColumn('tanggal_kembali');
            }

            if (Schema::hasColumn('peminjaman', 'denda')) {
                $table->dropColumn('denda');
            }

        });
    }
};