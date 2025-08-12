<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('masjids', function (Blueprint $table) {
            // Tambahkan kolom untuk surat bukti wakaf setelah kolom 'surat'
            $table->string('surat_wakaf')->nullable()->after('surat');

            // Tambahkan kolom untuk surat bukti takmir setelah 'surat_wakaf'
            $table->string('surat_takmir')->nullable()->after('surat_wakaf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masjids', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn(['surat_wakaf', 'surat_takmir']);
        });
    }
};
