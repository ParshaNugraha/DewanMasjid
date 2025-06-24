<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasjidsTable extends Migration
{
    public function up()
    {
        Schema::create('masjids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_masjid');
            $table->string('nama_takmir');
            $table->integer('tahun');
            $table->enum('status_tanah', ['Milik Sendiri', 'Wakaf', 'Sewa', 'Pinjam Pakai']);
            $table->enum('topologi_masjid', ['Masjid Jami', 'Masjid Negara', 'Masjid Agung', 'Masjid Raya', 'Masjid Besar', 'Masjid Kecil', 'Masjid Bersejarah']);
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('alamat');
            $table->string('gambar')->nullable()->comment('Foto/gambar masjid');
            $table->string('surat')->nullable()->comment('Surat keterangan Tanah atau dokumen legalitas');
            $table->string('notlp')->nullable()->comment('Nomor telepon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('masjids');
    }
}
