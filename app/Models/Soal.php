<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';
    protected $fillable = ['teks_pengantar', 'pertanyaan', 'pilihan_jawaban', 'kunci_jawaban'];

    protected $casts = [
        'pilihan_jawaban' => 'array',
    ];
}
