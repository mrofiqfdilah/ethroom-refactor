<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ETH ROOM | Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@700;800;900&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet" />

    <style>
        :root {
            --brown-dark: #3d2814;
            --brown-mid: #6b4423;
            --orange: #f2780c;
            --orange-light: #ffa94d;
            --orange-deep: #c4560a;
            --green: #1f7a3d;
            --green-light: #4caf50;
            --gold: #e8a33d;
            --cream: #fdf8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            background: linear-gradient(180deg, #8a4f00 60%, #9e5a00 75%, #b36a0a 88%, #c47d1a 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                repeating-linear-gradient(45deg, rgba(255, 255, 255, 0.04) 0px, rgba(255, 255, 255, 0.04) 2px, transparent 2px, transparent 26px),
                repeating-linear-gradient(-45deg, rgba(255, 255, 255, 0.04) 0px, rgba(255, 255, 255, 0.04) 2px, transparent 2px, transparent 26px),
                repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.02) 0px, rgba(255, 255, 255, 0.02) 1px, transparent 1px, transparent 8px),
                repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.02) 0px, rgba(255, 255, 255, 0.02) 1px, transparent 1px, transparent 8px);
            background-size: 28px 28px, 28px 28px, 8px 8px, 8px 8px;
            opacity: 0.6;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 8% 12%, rgba(252, 218, 93, 0.08) 0%, transparent 42%),
                radial-gradient(circle at 92% 8%, rgba(252, 218, 93, 0.10) 0%, transparent 45%),
                radial-gradient(circle at 85% 78%, rgba(255, 255, 255, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 15% 85%, rgba(252, 218, 93, 0.08) 0%, transparent 45%);
        }

        main {
            position: relative;
            z-index: 1;
        }

        .container-custom {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
            width: 100%;
        }

        @media (min-width: 640px) {
            .container-custom {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .container-custom {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        .greeting-wrapper {
            position: relative;
        }

        .greeting-card {
            background: linear-gradient(135deg, #1f7a3d 0%, #143d24 100%);
            border-radius: 20px;
            padding: 24px 32px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .greeting-card::before {
            background: rgba(232, 163, 61, 0.18);
        }

        .greeting-card::after {
            content: '';
            position: absolute;
            bottom: -60%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: rgba(252, 218, 93, 0.08);
            border-radius: 50%;
        }

        .greeting-card>* {
            position: relative;
            z-index: 1;
        }

        .stat-mini {
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(10px);
            border-radius: 14px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
            min-width: 90px;
        }

        .stat-mini:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-2px);
        }

        .stat-mini .stat-icon-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(252, 218, 93, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #fcda5d;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .stat-mini:hover .stat-icon-circle {
            background: rgba(252, 218, 93, 0.25);
            transform: scale(1.05) rotate(-4deg);
        }

        .stat-mini .stat-content {
            display: flex;
            flex-direction: column;
        }

        .stat-mini .number {
            font-size: 20px;
            font-weight: 800;
            color: #fcda5d;
            line-height: 1.1;
        }

        .stat-mini .label {
            font-size: 10px;
            opacity: 0.7;
            margin-top: 1px;
        }

        .stat-mini.green .stat-icon-circle {
            background: rgba(0, 91, 26, 0.25);
            color: #6fd98f;
        }

        .stat-mini.green:hover .stat-icon-circle {
            background: rgba(0, 91, 26, 0.35);
        }

        .cp-tp-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(252, 218, 93, 0.15);
            border: 1px solid rgba(252, 218, 93, 0.3);
            color: #fcda5d;
            font-size: 12px;
            font-weight: 700;
            padding: 8px 14px;
            border-radius: 999px;
            text-decoration: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .cp-tp-btn i:first-child {
            font-size: 14px;
        }

        .cp-tp-btn-arrow {
            font-size: 13px;
            transition: transform 0.3s ease;
        }

        .cp-tp-btn:hover {
            background: rgba(252, 218, 93, 0.25);
            border-color: rgba(252, 218, 93, 0.5);
            transform: translateY(-2px);
        }

        .cp-tp-btn:hover .cp-tp-btn-arrow {
            transform: translateX(3px);
        }

        @media (max-width: 640px) {
            .cp-tp-btn span {
                display: none;
            }

            .cp-tp-btn {
                padding: 8px 10px;
            }
        }

        .menu-card {
            transition: all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
            border: 2px solid transparent;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .menu-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(242, 120, 12, 0.06), rgba(31, 122, 61, 0.06));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-card:hover::before {
            opacity: 1;
        }

        .menu-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: var(--gold);
            box-shadow: 0 16px 34px rgba(242, 120, 12, 0.22);
        }

        .menu-card .icon-wrapper {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            font-size: 28px;
            background: rgba(31, 122, 61, 0.12);
            color: var(--green);
            transition: all 0.35s ease;
            position: relative;
            z-index: 1;
        }

        .menu-card .icon-wrapper img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .menu-card:hover .icon-wrapper {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
            color: white;
            transform: scale(1.1) rotate(-6deg);
            box-shadow: 0 6px 16px rgba(31, 122, 61, 0.35);
        }

        .menu-card .card-title,
        .menu-card .card-sub {
            position: relative;
            z-index: 1;
        }

        .section-label-vertical {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 2px;
            margin-bottom: 14px;
        }

        .section-label-vertical .dash {
            width: 26px;
            height: 4px;
            border-radius: 2px;
            background: #1f7a3d;
            margin-bottom: 4px;
        }

        .greeting-gif-wrap {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            pointer-events: none;
            z-index: 10;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .greeting-gif {
            height: 150px;
            width: auto;
            position: relative;
            top: 4px;
            object-fit: contain;
            filter: drop-shadow(0 6px 14px rgba(0, 0, 0, 0.25));
            display: block;
            -webkit-mask-image: linear-gradient(to bottom, black 0%, black 10%, transparent 100%);
            mask-image: linear-gradient(to bottom, black 0%, black 60%, transparent 100%);
        }

        /* ===== DESKTOP (>= 1025px) ===== */
        @media (min-width: 1025px) {
            .greeting-gif-wrap {
                width: 200px;
            }

            .greeting-gif {
                height: 150px;
            }
        }

        /* ===== TABLET (768px - 1024px) ===== */
        @media (min-width: 768px) and (max-width: 1024px) {
            .greeting-gif-wrap {
                width: 180px;
            }

            .greeting-gif {
                height: 180px;
            }
        }

        /* ===== HP (<= 767px) ===== */
        @media (max-width: 767px) {
            .greeting-gif-wrap {
                left: auto;
                right: 8px;
                bottom: -4px;
                transform: none;
                width: 190px;
                justify-content: flex-end;
            }

            .greeting-gif {
                height: 190px;
                top: 0;
            }
        }

        .section-label-vertical.is-green .dash {
            background: #edff2d;
        }

        .section-label-vertical .label-main {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #fff;
            margin: 0;
            line-height: 1.2;
        }

        .section-label-vertical .label-sub {
            font-size: 12px;
            font-weight: 400;
            color: #f4f5f8;
            margin: 0;
            line-height: 1.2;
            opacity: 0.75;
        }

        .activity-row {
            border: 1px solid rgba(242, 120, 12, 0.14);
            background: white;
            transition: all 0.25s ease;
        }

        .activity-row:hover {
            border-color: var(--gold);
            transform: translateX(6px);
            box-shadow: 0 8px 20px rgba(242, 120, 12, 0.14);
        }

        .activity-dot {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .tenggat-card {
            background: white;
            border: 1px solid rgba(242, 120, 12, 0.16);
            transition: box-shadow 0.3s ease;
        }

        .tenggat-card:hover {
            box-shadow: 0 12px 28px rgba(61, 40, 20, 0.1);
        }

        .tenggat-date {
            transition: transform 0.3s ease;
        }

        .tenggat-item:hover .tenggat-date {
            transform: scale(1.08) rotate(-3deg);
        }

        .badge-new {
            background: rgba(31, 122, 61, 0.12);
            color: var(--green);
        }

        .badge-active {
            background: rgba(242, 120, 12, 0.12);
            color: var(--orange);
        }

        @media (max-width: 640px) {
            .greeting-card {
                padding: 18px 150px 18px 20px;
                min-height: 190px;   /* tinggi minimum kartu supaya GIF yang lebih besar tetap muat */
            }

            .stat-mini {
                padding: 8px 12px;
                min-width: 70px;
                gap: 8px;
            }

            .stat-mini .stat-icon-circle {
                width: 30px;
                height: 30px;
                font-size: 13px;
            }

            .stat-mini .number {
                font-size: 16px;
            }

            .stat-mini .label {
                font-size: 9px;
            }
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    @include('components.navbar.navbar-siswa')

    <main class="container-custom py-8 md:py-12 flex-1 w-full">

        <div class="greeting-wrapper mb-8">
            <div class="greeting-card">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm text-white/70 font-medium">Selamat datang,</p>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-white">{{ $siswa->nama_lengkap }}</h2>
                        <p class="text-sm text-white/60 mt-1">
                            Kelas {{ $siswa->kelas->nama_kelas ?? '-' }} · NISN {{ $siswa->nisn }}
                        </p>
                    </div>

                    <div class="flex flex-col items-start md:items-end gap-3">
                          <a href="#" class="cp-tp-btn">
                            <i class="ri-flag-2-line"></i>
                            <span>Capaian & Tujuan Pembelajaran</span>
                            <i class="ri-arrow-right-line cp-tp-btn-arrow"></i>
                        </a>
                        <div class="flex flex-wrap gap-3">
                            <div class="stat-mini green">
                                <div class="stat-icon-circle"><i class="ri-file-text-line"></i></div>
                                <div class="stat-content">
                                    <div class="number">85%</div>
                                    <div class="label">Kehadiran</div>
                                </div>
                            </div>
                            <div class="stat-mini">
                                <div class="stat-icon-circle"><i class="ri-bar-chart-line"></i></div>
                                <div class="stat-content">
                                    <div class="number">90</div>
                                    <div class="label">Nilai Rata-rata</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="greeting-gif-wrap flex">
                <img src="{{ asset('gif/nino-home.gif') }}" alt="Karakter ETH ROOM" class="greeting-gif" />
            </div>
        </div>

        <div class="section-label-vertical is-green">
            <span class="dash"></span>
            <p class="label-main">Menu Utama</p>
            <p class="label-sub">Pilihan aktivitas belajar</p>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-10">
            <a href="#" class="menu-card rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md">
                <div class="flex flex-col items-center text-center">
                    <div class="icon-wrapper mb-3 md:mb-4">
                        <img src="{{ asset('images/icon-literasi.png') }}" alt="">
                    </div>
                    <h3 class="card-title text-base md:text-lg font-bold" style="color: var(--green);">Ethno Literacy</h3>
                    <p class="card-sub text-xs md:text-sm mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Pelajari & Pahami</p>
                </div>
            </a>

            <a href="#" class="menu-card rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md">
                <div class="flex flex-col items-center text-center">
                    <div class="icon-wrapper mb-3 md:mb-4">
                        <img src="{{ asset('images/icon-aktivitas.png') }}" alt="">
                    </div>
                    <h3 class="card-title text-base md:text-lg font-bold" style="color: var(--green);">Ethno Activity</h3>
                    <p class="card-sub text-xs md:text-sm mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Penugasan LKM</p>
                </div>
            </a>

            <a href="#" class="menu-card rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md">
                <div class="flex flex-col items-center text-center">
                    <div class="icon-wrapper mb-3 md:mb-4">
                        <img src="{{ asset('images/icon-lab.png') }}" alt="">
                    </div>
                    <h3 class="card-title text-base md:text-lg font-bold" style="color: var(--green);">Ethno Laboratory</h3>
                    <p class="card-sub text-xs md:text-sm mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Simulasi & Lab Virtual</p>
                </div>
            </a>

            <a href="#" class="menu-card rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md">
                <div class="flex flex-col items-center text-center">
                    <div class="icon-wrapper mb-3 md:mb-4">
                        <img src="{{ asset('images/icon-presensi.png') }}" alt="">
                    </div>
                    <h3 class="card-title text-base md:text-lg font-bold" style="color: var(--green);">Ethno Presensi</h3>
                    <p class="card-sub text-xs md:text-sm mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Absensi harian</p>
                </div>
            </a>

            <a href="#" class="menu-card rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md">
                <div class="flex flex-col items-center text-center">
                    <div class="icon-wrapper mb-3 md:mb-4">
                        <img src="{{ asset('images/icon-diskusi.png') }}" alt="">
                    </div>
                    <h3 class="card-title text-base md:text-lg font-bold" style="color: var(--green);">Ethno Discuss</h3>
                    <p class="card-sub text-xs md:text-sm mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Diskusi & kolaborasi</p>
                </div>
            </a>

            <a href="#" class="menu-card rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md">
                <div class="flex flex-col items-center text-center">
                    <div class="icon-wrapper mb-3 md:mb-4">
                        <img src="{{ asset('images/icon-evaluation.png') }}" alt="">
                    </div>
                    <h3 class="card-title text-base md:text-lg font-bold" style="color: var(--green);">Ethno Evaluation</h3>
                    <p class="card-sub text-xs md:text-sm mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Review & Evaluasi</p>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
            <div class="lg:col-span-2">
                <div class="section-label-vertical is-green">
                    <span class="dash"></span>
                    <p class="label-main">Aktivitas Terbaru</p>
                    <p class="label-sub">Riwayat kegiatan belajarmu - Kelas {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="activity-row rounded-xl p-4 flex items-center gap-4">
                        <div class="activity-dot" style="background: rgba(31,122,61,0.12); color: var(--green);">
                            <i class="ri-checkbox-circle-line"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-stone-800 truncate">{{ $siswa->kelas->nama_kelas ?? '-' }} - Menyelesaikan LKM "Faktor-faktor yang Mempengaruhi Laju Reaksi"</p>
                            <p class="text-xs mt-0.5" style="color: var(--brown-mid); opacity:0.75;">2 jam yang lalu</p>
                        </div>
                        <span class="hidden sm:inline-flex text-[10px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-full" style="background: rgba(31,122,61,0.12); color: var(--green);">Selesai</span>
                    </div>
                    <div class="activity-row rounded-xl p-4 flex items-center gap-4">
                        <div class="activity-dot" style="background: rgba(242,120,12,0.12); color: var(--orange);">
                            <i class="ri-add-circle-line"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-stone-800 truncate">{{ $siswa->kelas->nama_kelas ?? '-' }} - Materi baru "Pengaruh Suhu dan Katalis dalam Laju Reaksi" tersedia</p>
                            <p class="text-xs mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Kemarin, 15:40</p>
                        </div>
                        <span class="hidden sm:inline-flex text-[10px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-full" style="background: rgba(242,120,12,0.12); color: var(--orange);">Baru</span>
                    </div>
                    <div class="activity-row rounded-xl p-4 flex items-center gap-4">
                        <div class="activity-dot" style="background: rgba(31,122,61,0.12); color: var(--green);">
                            <i class="ri-community-line"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-stone-800 truncate">{{ $siswa->kelas->nama_kelas ?? '-' }} - Diskusi Kelas "Penerapan Laju Reaksi dalam Kehidupan Sehari-hari" telah dimulai</p>
                            <p class="text-xs mt-0.5" style="color: var(--brown-mid); opacity:0.75;">2 hari yang lalu</p>
                        </div>
                        <span class="hidden sm:inline-flex text-[10px] font-bold uppercase tracking-wide px-2.5 py-1 rounded-full" style="background: rgba(31,122,61,0.12); color: var(--green);">Aktif</span>
                    </div>
                </div>
            </div>

            <div>
                <div class="section-label-vertical is-green">
                    <span class="dash"></span>
                    <p class="label-main">Tenggat Terdekat</p>
                    <p class="label-sub">Jangan sampai terlewat - {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>
                <div class="tenggat-card rounded-2xl p-5 flex flex-col gap-4 shadow-sm">
                    <div class="tenggat-item flex items-start gap-3">
                        <div class="tenggat-date w-12 h-12 rounded-lg text-white flex flex-col items-center justify-center leading-none flex-shrink-0" style="background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);">
                            <span class="text-[10px] font-semibold uppercase">Jul</span>
                            <span class="text-sm font-extrabold">05</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-stone-800">Kumpulkan LKM Laju Reaksi</p>
                            <p class="text-xs mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Batas akhir hari ini - {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="border-t border-dashed" style="border-color: rgba(242,120,12,0.25);"></div>
                    <div class="tenggat-item flex items-start gap-3">
                        <div class="tenggat-date w-12 h-12 rounded-lg text-white flex flex-col items-center justify-center leading-none flex-shrink-0" style="background: linear-gradient(135deg, var(--orange) 0%, var(--orange-deep) 100%);">
                            <span class="text-[10px] font-semibold uppercase">Jul</span>
                            <span class="text-sm font-extrabold">08</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-stone-800">Latihan Soal Energi Aktivasi</p>
                            <p class="text-xs mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Kerjakan 10 soal laju reaksi - {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="border-t border-dashed" style="border-color: rgba(242,120,12,0.25);"></div>
                    <div class="tenggat-item flex items-start gap-3">
                        <div class="tenggat-date w-12 h-12 rounded-lg text-white flex flex-col items-center justify-center leading-none flex-shrink-0" style="background: var(--gold);">
                            <span class="text-[10px] font-semibold uppercase">Jul</span>
                            <span class="text-sm font-extrabold">12</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-stone-800">Presentasi Luas Permukaan Reaksi</p>
                            <p class="text-xs mt-0.5" style="color: var(--brown-mid); opacity:0.75;">Siapkan presentasi - {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>

</html>
