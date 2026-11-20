<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ETH ROOM | Modalities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/siswa/tes_kognitif.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@700;800;900&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>

    <!-- ===== OVERLAY PEMBUKA ===== -->
    <div id="overlayWelcome" class="overlay-with-close show">
        <div class="content-wrapper">
            <img id="welcomeGif" src="{{ asset('gif/nino-welcome.gif') }}" alt="Welcome" class="hidden-gif" />
        </div>
    </div>

    <!-- ===== OVERLAY REACTION ===== -->
    <div id="overlayReaction" class="overlay-with-close">
        <div class="content-wrapper">
            <img src="{{ asset('gif/nino-jelasin.gif') }}" alt="Reaction" />
        </div>
    </div>

    <!-- ===== OVERLAY VISUAL ===== -->
    <div id="overlayVisual" class="overlay-with-close">
        <div class="content-wrapper">
            <img src="{{ asset('gif/nino-jelasin.gif') }}" alt="Visual" />
        </div>
    </div>

    <!-- ===== CUSTOM POPUP ===== -->
    <div id="customPopup" class="popup-overlay">
        <div class="popup-box">
            <div id="popupIcon" class="popup-icon success"><i class="ri-check-line"></i></div>
            <h3 id="popupTitle" class="popup-title">Success!</h3>
            <p id="popupMessage" class="popup-message">Your message here</p>
            <button id="popupButton" class="popup-btn primary">OK</button>
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
       <!-- ===== MAIN CONTENT ===== -->
    <main class="container-custom py-8 md:py-12" style="position:relative; z-index:1;">

        <!-- Form Kuis -->
        <form id="formKuis">
            @csrf
            <!-- STEP 1 -->
            <div id="step1" class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-[#ac6700]/10">
                <h2 class="text-xl font-bold text-[#1f7a3d] text-center mb-2">Tes Kognitif</h2>
                <p class="text-sm text-[#6a4c2f]/60 text-center mb-6">Jawablah {{ count($daftar_soal) }} soal pilihan ganda berikut</p>

                <div id="questions-container" class="space-y-4">
                   @foreach ($daftar_soal as $index => $soal)
    @if ($soal->teks_pengantar)
        <div class="stimulus-card">
            {!! $soal->teks_pengantar !!}
        </div>
    @endif

    <div class="question-card">
        <p class="font-semibold text-[#1f7a3d] text-sm mb-3">{{ $index + 1 }}. {!! $soal->pertanyaan !!}</p>
        <div class="space-y-2">
            @foreach ($soal->pilihan_jawaban as $optIndex => $opsi)
                @php $huruf = chr(65 + $optIndex); @endphp
                <label class="option-label">
                    <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $huruf }}" />
                    <span class="option-text text-sm text-[#6a4c2f]">{{ $huruf }}. {{ $opsi }}</span>
                </label>
            @endforeach
        </div>
    </div>
@endforeach
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-6 pt-4 border-t border-[#ac6700]/10">
                    <button type="button" onclick="submitJawaban()" class="btn-primary" id="btnSubmitSoal">Submit Jawaban</button>
                </div>

                <div id="ai-rekomendasi" class="mt-6 hidden">
                    <div class="ai-box">
                        <div class="flex items-start gap-3">
                            <i class="ri-google-gemini-fill text-2xl text-[#ac6700] flex-shrink-0 mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-[#1f7a3d] text-sm">Rekomendasi AI</h4>
                                <p id="ai-text" class="text-sm text-[#6a4c2f]/70 mt-1"></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="button" onclick="goToStep2()" class="btn-primary">Lanjut ke Pilih Modality</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- STEP 2 -->
        <div id="step2" class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-[#ac6700]/10 hidden">
            <button class="back-btn" onclick="goToStep1()"><i class="ri-arrow-left-line"></i> Kembali ke Soal</button>
            <h2 class="text-xl font-bold text-[#1f7a3d] text-center mb-2">Silahkan Pilih Learning Modalities</h2>
            <p class="text-sm text-[#6a4c2f]/60 text-center mb-6">Pilih gaya belajar yang paling sesuai dengan preferensimu</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6">
                <div class="modality-card" data-modality="visual" onclick="selectModality(this)">
                    <div class="icon-wrapper">
                        <img src="{{ asset('images/visual.png') }}" alt="Visual">
                    </div>
                    <h3 class="text-lg font-bold text-[#1f7a3d]">Visual</h3>
                    <p class="text-xs text-[#6a4c2f]/60 mt-1">Belajar melalui gambar, diagram, dan visualisasi</p>
                </div>
                <div class="modality-card" data-modality="auditory" onclick="selectModality(this)">
                    <div class="icon-wrapper">
                        <img src="{{ asset('images/audio.png') }}" alt="Auditory">
                    </div>
                    <h3 class="text-lg font-bold text-[#1f7a3d]">Auditory</h3>
                    <p class="text-xs text-[#6a4c2f]/60 mt-1">Belajar melalui pendengaran, musik, dan diskusi</p>
                </div>
                <div class="modality-card" data-modality="reading" onclick="selectModality(this)">
                    <div class="icon-wrapper">
                        <img src="{{ asset('images/reading.png') }}" alt="Reading">
                    </div>
                    <h3 class="text-lg font-bold text-[#1f7a3d]">Reading</h3>
                    <p class="text-xs text-[#6a4c2f]/60 mt-1">Belajar melalui gerakan, sentuhan, dan praktik langsung</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-6 pt-4 border-t border-[#ac6700]/10">
                <button onclick="finish()" class="btn-primary" id="btnFinish" disabled>Selesai</button>
            </div>
        </div>

        <!-- STEP INDICATOR -->
        <div class="step-indicator">
            <span class="step-dot active" id="dot1"></span>
            <span class="step-dot" id="dot2"></span>
        </div>

    </main>

    <!-- Panggil file JS eksternal -->
    <script src="{{ asset('js/siswa/tes_kognitif.js') }}"></script>
</body>

</html>
