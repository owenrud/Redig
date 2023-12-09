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
        Schema::create('peserta_event', function (Blueprint $table) {
            $table->id('ID_peserta');
            $table->foreignId('ID_event');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('type');
            $table->string('instansi')->nullable();
            $table->string('nama_ruang')->nullable();
            $table->string('no_meja')->nullable();
            $table->integer('kode_doorprize');
            $table->string('payment_url')->nullable();
            $table->string('payment_status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_events');
    }
};
