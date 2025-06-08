<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable(); // path gambar
            $table->string('tag')->nullable(); // misalnya: DMI Jateng
            $table->string('author_name')->nullable(); // bisa manual atau ambil dari users
            $table->unsignedBigInteger('author_id')->nullable(); // foreign key (optional)
            $table->integer('read_duration')->nullable(); // menit
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
