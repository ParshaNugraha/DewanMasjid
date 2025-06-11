<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('masjids', function (Blueprint $table) {
            $table->string('donasi')->nullable()->comment('Nomor rekening untuk donasi');
        });
    }

    public function down()
    {
        Schema::table('masjids', function (Blueprint $table) {
            $table->dropColumn('donasi');
        });
    }
};