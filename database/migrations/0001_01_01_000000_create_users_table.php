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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_masjid');
            $table->string('nama_takmir');
            $table->integer('tahun');
            $table->enum('status_tanah', ['Milik Sendiri', 'Wakaf', 'Sewa', 'Pinjam Pakai']);
            $table->enum('topologi_masjid', ['Masjid Jami', 'Masjid Negara', 'Masjid Agung', 'Masjid Raya', 'Masjid Besar', 'Masjid Kecil']);
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('alamat');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('gambar')->nullable()->comment('Foto/gambar masjid');
            $table->string('surat')->nullable()->comment('Surat keterangan Tanah atau dokumen legalitas');
            $table->string('notlp')->nullable()->comment('Nomor telepon');
            $table->rememberToken();
            $table->timestamps();
            $table->enum('role', ['superadmin', 'admin'])->default('admin');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};