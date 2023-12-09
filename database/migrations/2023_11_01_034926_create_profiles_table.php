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
        Schema::create('profile', function (Blueprint $table) {
            $table->foreignId('ID_User');
            $table->integer('Kategori_paket');
            $table->string('nama_lengkap');
            $table->string('no_telp');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('foto');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
