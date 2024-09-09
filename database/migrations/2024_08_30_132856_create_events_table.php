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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('nama_event');
            $table->date('mulai');
            $table->date('berakhir');
            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->unsignedBigInteger('categori_id');
            $table->foreign('categori_id')->references('id')->on('categoris');
            $table->string('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
