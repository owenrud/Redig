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
        Schema::create('detail_event', function (Blueprint $table) {
            $table->foreignId('ID_event');
            $table->foreignId('ID_kategori');
            $table->string('alamat');
            $table->foreignId('provinsi');
            $table->foreignId('kabupaten');
            $table->integer('lat');
            $table->integer('long');
            $table->string('banner');
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_events');
    }
};
