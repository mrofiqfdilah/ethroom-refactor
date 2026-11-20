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
       Schema::create('hasil_kognitif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->integer('jumlah_benar');
            $table->integer('total_soal');
            $table->integer('nilai'); // Dalam bentuk persentase (0-100)
            $table->string('label'); // 'High Cognitive' atau 'Low Cognitive'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kognitif');
    }
};
