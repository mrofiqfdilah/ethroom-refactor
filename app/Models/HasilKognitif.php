<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKognitif extends Model
{
    use HasFactory;

    protected $table = 'hasil_kognitif';

    protected $fillable = [
        'id_user',
        'jumlah_benar',
        'total_soal',
        'nilai',
        'label'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
