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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Event');
            $table->string('background');
            $table->string('logo');
            $table->string('ttd');
            $table->string('nama_ketu_panitia');
            $table->string('kota_diterbitkan');
            $table->date('tanggal_diterbitkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
