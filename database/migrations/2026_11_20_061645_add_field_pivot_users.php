<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_sekolah')->nullable()->after('role')->constrained('sekolah')->nullOnDelete();
            $table->foreignId('id_kelas')->nullable()->after('id_sekolah')->constrained('kelas_sekolah')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_sekolah']);
            $table->dropForeign(['id_kelas']);
            $table->dropColumn(['id_sekolah', 'id_kelas']);
        });
    }
};
