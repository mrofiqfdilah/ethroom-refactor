<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah';

    protected $fillable = ['nama_sekolah'];

    public function kelas()
    {
        return $this->hasMany(KelasSekolah::class, 'id_sekolah');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_sekolah');
    }
}
