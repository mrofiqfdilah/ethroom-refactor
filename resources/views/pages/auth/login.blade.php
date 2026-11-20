<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ETH ROOM | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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
                    ETH-ROOM
                </h1>
                <p class="text-sm text-amber-800/70 mt-1 font-medium tracking-wide">Silahkan masuk untuk memulai pembelajaran</p>
            </div>

            <form action="{{ route('login_store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Email</label>
                    <div class="relative">
                        <i class="ri-mail-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full pl-11 pr-4 py-3.5 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 placeholder:text-stone-400/70 input-focus-ring transition-all duration-200" placeholder="nama@email.com" required autofocus />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-stone-700 uppercase tracking-widest mb-1.5">Password</label>
                    <div class="relative">
                        <i class="ri-lock-line absolute left-3.5 top-1/2 -translate-y-1/2 text-amber-600/60 text-lg"></i>
                        <input type="password" name="password" id="password" class="w-full pl-11 pr-12 py-3.5 bg-white/70 border border-amber-200/60 rounded-xl text-stone-800 placeholder:text-stone-400/70 input-focus-ring transition-all duration-200" placeholder="••••••••" required />
                        <button type="button" onclick="togglePassword()" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-stone-400 hover:text-amber-700 transition-colors duration-200">
                            <i id="eye-icon" class="ri-eye-line text-xl"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4.5 h-4.5 accent-amber-700 rounded border-amber-300/60 focus:ring-2 focus:ring-amber-400/50 focus:ring-offset-1 transition-all" />
                        <span class="text-sm text-stone-600 group-hover:text-stone-800 transition-colors">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-sm font-semibold text-amber-700 hover:text-amber-900 hover:underline transition-colors">
                        Lupa Password?
                    </a>
                </div>

                <button type="submit" class="w-full relative top-3 bg-stone-800 hover:bg-stone-900 text-white font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-stone-900/20 hover:shadow-stone-900/40 active:scale-[0.98]">
                    Masuk Sekarang
                </button>
            </form>

            <div class="text-center mt-5 pt-4 border-t border-amber-200/30">
                <p class="text-sm text-stone-600">
                    Belum punya akun?
                    <a href="{{ route('register_page') }}" class="font-semibold text-amber-700 hover:text-amber-900 hover:underline transition-colors">
                        Daftar disini
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
