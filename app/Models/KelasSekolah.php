<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSekolah extends Model
{
    use HasFactory;

    protected $table = 'kelas_sekolah';

    protected $fillable = ['id_sekolah', 'nama_kelas'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_kelas');
    }
}
