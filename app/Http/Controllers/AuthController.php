<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register_page()
    {
        $sekolah = Sekolah::all();
        return view('pages.auth.register', compact('sekolah'));
    }

    public function login_page()
    {
        return view('pages.auth.login');
    }

    public function register_store(Request $request)
{
    $rules = [
        'nama_lengkap'   => 'required|string|max:255',
        'email'          => 'required|string|email|max:255|unique:users,email',
        'password'       => ['required', 'string', Password::min(8)],
        'role'           => 'required|in:Guru,Siswa',
        'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
        'id_sekolah'     => 'required|exists:sekolah,id',
    ];

    if ($request->role === 'Guru') {
        $rules['nip'] = ['required', 'digits:18', 'unique:users,nip'];
    } elseif ($request->role === 'Siswa') {
        $rules['nisn']     = ['required', 'digits:10', 'unique:users,nisn'];
        $rules['id_kelas'] = ['required', 'exists:kelas_sekolah,id'];
    }

    $request->validate($rules, [
        'nip.required'           => 'NIP wajib diisi untuk Guru.',
        'nip.digits'             => 'NIP harus berjumlah 18 digit.',
        'nip.unique'             => 'NIP sudah terdaftar.',
        'nisn.required'          => 'NISN wajib diisi untuk Siswa.',
        'nisn.digits'            => 'NISN harus berjumlah 10 digit.',
        'nisn.unique'            => 'NISN sudah terdaftar.',
        'jenis_kelamin.required' => 'Silahkan pilih jenis kelamin Anda.',
        'id_sekolah.required'    => 'Sekolah wajib dipilih.',
        'id_kelas.required'      => 'Kelas wajib dipilih untuk Siswa.',
    ]);

    $user = User::create([
        'nama_lengkap'   => $request->nama_lengkap,
        'email'          => $request->email,
        'password'       => Hash::make($request->password),
        'role'           => $request->role,
        'jenis_kelamin'  => $request->jenis_kelamin,
        'id_sekolah'     => $request->id_sekolah,
        'id_kelas'       => $request->role === 'Siswa' ? $request->id_kelas : null,
        'nip'            => $request->role === 'Guru' ? $request->nip : null,
        'nisn'           => $request->role === 'Siswa' ? $request->nisn : null,
    ]);

        Auth::login($user);

    if ($user->role === 'Guru') {
        return redirect()->route('guru.dashboard')->with('success', 'Selamat datang Guru ' . $user->nama_lengkap . '!');
    }

    return redirect()->route('siswa.dashboard')->with('success', 'Selamat datang Siswa ' . $user->nama_lengkap . '!');
}

   public function login_store(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'Guru') {
            return redirect()->intended('/guru/dashboard')->with('success', 'Selamat datang Guru ' . Auth::user()->nama_lengkap . '!');
        }

        return redirect()->intended(route('siswa.home'))->with('success', 'Selamat datang ' . Auth::user()->nama_lengkap . '!');
    }

    return back()->withErrors([
        'email' => 'Email atau password yang Anda masukkan salah.',
    ])->onlyInput('email');
}

    public function logout_store(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
