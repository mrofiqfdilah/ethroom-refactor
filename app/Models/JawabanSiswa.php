<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';

    protected $fillable = [
        'id_user',
        'id_soal',
        'jawaban_dipilih',
        'is_benar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }
}
