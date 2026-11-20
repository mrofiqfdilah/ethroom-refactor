<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ETH ROOM | Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md relative my-4">
        <div class="absolute -top-16 -right-16 w-56 h-56 bg-amber-400/15 rounded-full blur-3xl animate-warm-pulse-slow pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-orange-300/10 rounded-full blur-3xl animate-warm-pulse pointer-events-none"></div>

        <div class="glass-card rounded-3xl shadow-2xl p-8 relative z-10">
            <div class="text-center mb-6">
                <div class="flex justify-center mb-4">
                    <div class="relative group">
                        <div class="absolute -inset-3 bg-amber-400/20 rounded-full blur-xl animate-warm-pulse-slow"></div>
                        <div class="absolute -inset-1.5 bg-amber-500/10 rounded-full blur-md animate-warm-pulse"></div>
                        <div class="relative logo-wrapper z-10">
                            <img src="{{ asset('images/auth-logo.png') }}" alt="ClassInsight Logo" class="w-full h-full object-contain drop-shadow-md" />
                        </div>
                    </div>
                </div>
                <h1 class="text-3xl font-extrabold tracking-tight" style="background: linear-gradient(135deg, #2d1f0e, #5a3d1a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Daftar Akun
                </h1>
                <p class="text-sm text-amber-800/70 mt-1 font-medium tracking-wide">
                    Lengkapi data untuk bergabung dengan ETH-ROOM
                </p>
            </div>

            <form action="{{ route('register_store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nama_lengkap" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <i class="ri-user-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full pl-11 pr-4 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 placeholder:text-stone-400/70 input-focus-ring transition-all duration-200" placeholder="Nama Lengkap Anda" required />
                    </div>
                </div>

                <div>
                    <label for="role" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Mendaftar Sebagai</label>
                    <div class="relative">
                        <i class="ri-user-settings-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <select name="role" id="role" onchange="handleRoleChange()" class="w-full pl-11 pr-4 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 input-focus-ring transition-all duration-200 appearance-none cursor-pointer">
                            <option value="Guru" {{ old('role', 'Guru') == 'Guru' ? 'selected' : '' }}>Guru</option>
                            <option value="Siswa" {{ old('role') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                        </select>
                        <i class="ri-arrow-down-s-line absolute right-3.5 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none text-xl"></i>
                    </div>
                </div>

                <div>
                    <label for="id_sekolah" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Sekolah</label>
                    <div class="relative">
                        <i class="ri-building-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <select name="id_sekolah" id="id_sekolah" onchange="loadKelas()" class="w-full pl-11 pr-4 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 input-focus-ring transition-all duration-200 appearance-none cursor-pointer" required>
                            <option value="">-- Pilih Sekolah --</option>
                            @foreach ($sekolah as $s)
                                <option value="{{ $s->id }}" {{ old('id_sekolah') == $s->id ? 'selected' : '' }}>{{ $s->nama_sekolah }}</option>
                            @endforeach
                        </select>
                        <i class="ri-arrow-down-s-line absolute right-3.5 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none text-xl"></i>
                    </div>
                </div>

                <div id="kelasContainer" class="{{ old('role') == 'Siswa' ? '' : 'hidden' }}">
                    <label for="id_kelas" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Kelas</label>
                    <div class="relative">
                        <i class="ri-community-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <select name="id_kelas" id="id_kelas" data-old="{{ old('id_kelas') }}" class="w-full pl-11 pr-4 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 input-focus-ring transition-all duration-200 appearance-none cursor-pointer">
                            <option value="">-- Pilih Kelas --</option>
                        </select>
                        <i class="ri-arrow-down-s-line absolute right-3.5 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none text-xl"></i>
                    </div>
                </div>

                <div>
                    <label id="identityLabel" for="nip" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">
                        {{ old('role') == 'Siswa' ? 'NISN' : 'NIP' }}
                    </label>
                    <div class="relative">
                        <i class="ri-id-card-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>

                        <input type="text" inputmode="numeric" pattern="[0-9]{18}" maxlength="18"
                            name="nip" id="nip" value="{{ old('nip') }}"
                            class="w-full pl-11 pr-4 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 placeholder:text-stone-400/70 input-focus-ring transition-all duration-200"
                            placeholder="Masukkan NIP Anda (18 digit)" />

                        <input type="text" inputmode="numeric" pattern="[0-9]{10}" maxlength="10"
                            name="nisn" id="nisn" value="{{ old('nisn') }}"
                            class="w-full pl-11 pr-4 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 placeholder:text-stone-400/70 input-focus-ring transition-all duration-200 hidden"
                            placeholder="Masukkan NISN Anda (10 digit)" />
                    </div>
                </div>

               <div>
    <label class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Jenis Kelamin</label>
    <div class="flex gap-3">
        <label class="gender-option {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}" id="label-male">
            <input type="radio" name="jenis_kelamin" value="Laki-laki" id="radio-male" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required />
            <span class="gender-icon">
                <img src="{{ asset('images/nino-cowo.png') }}" alt="Laki-laki">
            </span>
            <span class="gender-label">Laki-laki</span>
        </label>
        <label class="gender-option {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}" id="label-female">
            <input type="radio" name="jenis_kelamin" value="Perempuan" id="radio-female" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} />
            <span class="gender-icon">
                <img src="{{ asset('images/nina-cewe.png') }}" alt="Perempuan">
            </span>
            <span class="gender-label">Perempuan</span>
        </label>
    </div>
</div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Email</label>
                    <div class="relative">
                        <i class="ri-mail-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full pl-11 pr-4 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 placeholder:text-stone-400/70 input-focus-ring transition-all duration-200" placeholder="nama@email.com" required />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Password</label>
                    <div class="relative">
                        <i class="ri-lock-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <input type="password" name="password" id="password" class="w-full pl-11 pr-12 py-3 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 placeholder:text-stone-400/70 input-focus-ring transition-all duration-200" placeholder="Minimal 8 karakter" required />
                        <button type="button" onclick="togglePassword()" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-stone-400 hover:text-amber-700 transition-colors duration-200">
                            <i id="eye-icon" class="ri-eye-line text-xl"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-stone-800 hover:bg-stone-900 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-stone-900/20 hover:shadow-stone-900/40 active:scale-[0.98] mt-5 relative top-3">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center mt-5 pt-4 border-t border-amber-200/30">
                <p class="text-sm text-stone-600">
                    Sudah punya akun?
                    <a href="{{ route('login_page') }}" class="font-semibold text-amber-700 hover:text-amber-900 hover:underline transition-colors">
                        Masuk disini
                    </a>
                </p>
                <p class="text-[10px] text-stone-500/70 font-medium tracking-wide mt-4">
                    &copy; 2026 by Team ETH-ROOM UM
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
