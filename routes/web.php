<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswa\HomeController as HomeSiswa;
use App\Http\Controllers\Siswa\TesKognitifController;
use App\Models\KelasSekolah;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('register', [AuthController::class, 'register_page'])->name('register_page');
Route::get('login', [AuthController::class, 'login_page'])->name('login_page');

Route::post('register_store', [AuthController::class, 'register_store'])->name('register_store');
Route::post('login_store', [AuthController::class, 'login_store'])->name('login_store');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('home', [HomeSiswa::class, 'home'])->name('home');
    Route::get('/tes_kognitif', [TesKognitifController::class, 'index'])->name('tes_kognitif');
    Route::post('/tes-kognitif/simpan', [TesKognitifController::class, 'simpanJawaban'])->name('tes_kognitif.simpan');
});

// PEMBANTU
Route::get('/api/sekolah/{id_sekolah}/kelas', function ($id_sekolah) {
    return response()->json(KelasSekolah::where('id_sekolah', $id_sekolah)->get());
});
