<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('register', [AuthController::class, 'register_page'])->name('register_page');
Route::get('login', [AuthController::class, 'login_page'])->name('login_page');

Route::post('register_store', [AuthController::class, 'register_store'])->name('register_store');
Route::post('login_store', [AuthController::class, 'login_store'])->name('login_store');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
