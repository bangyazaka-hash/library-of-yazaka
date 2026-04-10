<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            if (!Schema::hasColumn('anggota', 'jenis_kelamin')) {
                $table->string('jenis_kelamin')->nullable()->after('kelas');
            }

            if (!Schema::hasColumn('anggota', 'alamat')) {
                $table->text('alamat')->nullable()->after('jenis_kelamin');
            }

            if (!Schema::hasColumn('anggota', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('alamat');
            }

            if (!Schema::hasColumn('anggota', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('no_hp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            if (Schema::hasColumn('anggota', 'jenis_kelamin')) {
                $table->dropColumn('jenis_kelamin');
            }

            if (Schema::hasColumn('anggota', 'alamat')) {
                $table->dropColumn('alamat');
            }

            if (Schema::hasColumn('anggota', 'no_hp')) {
                $table->dropColumn('no_hp');
            }

            if (Schema::hasColumn('anggota', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};