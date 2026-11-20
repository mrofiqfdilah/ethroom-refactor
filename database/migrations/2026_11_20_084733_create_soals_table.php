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
       Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->text('teks_pengantar')->nullable(); // Untuk teks bacaan/stimulus
            $table->text('pertanyaan');
            $table->json('pilihan_jawaban'); // Menyimpan opsi A, B, C, D, E
            $table->string('kunci_jawaban', 1); // A, B, C, D, E
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
