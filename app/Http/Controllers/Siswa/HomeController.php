<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $siswa = Auth::user()->load(['sekolah', 'kelas']);
        return view('pages.siswa.home', compact('siswa'));
    }
}
