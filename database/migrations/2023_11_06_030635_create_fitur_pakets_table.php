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
        Schema::create('fitur_paket', function (Blueprint $table) {
            $table->id('ID_fitur');
            $table->integer('scan_count');
            $table->integer('file_up_count');
            $table->integer('guest_count');
            $table->integer('operator_count');
            $table->integer('sertif_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitur_pakets');
    }
};
