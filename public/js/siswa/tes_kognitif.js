// ===== DURASI SETTING (dalam milidetik) =====
const DURATION_WELCOME = 7500;
const DURATION_REACTION = 3400;
const DURATION_VISUAL = 6000;

const DELAY_WELCOME_VOICE = 300;
const DELAY_WELCOME_GIF = 1000;

// ===== AUDIO TRACKER =====
let activeAudio = null;
let overlayTimeouts = {};
let welcomeVoiceTimeout = null;
let isWelcomeVoicePlaying = false;
let welcomeGifTimeout = null;

function playAudio(src) {
    if (activeAudio) {
        activeAudio.pause();
        activeAudio.currentTime = 0;
        activeAudio = null;
    }

    const audio = new Audio(src);
    audio.preload = 'auto';
    audio.play()
        .then(() => {
            activeAudio = audio;
            console.log('Audio berhasil diputar:', src);
        })
        .catch(e => {
            console.warn('Audio play gagal:', src, e);
            setTimeout(() => {
                const retryAudio = new Audio(src);
                retryAudio.play().catch(err => console.warn('Retry gagal:', err));
            }, 500);
        });
}

function stopAudio() {
    if (activeAudio) {
        activeAudio.pause();
        activeAudio.currentTime = 0;
        activeAudio = null;
    }
    if (welcomeVoiceTimeout) {
        clearTimeout(welcomeVoiceTimeout);
        welcomeVoiceTimeout = null;
    }
    isWelcomeVoicePlaying = false;
}

// ===== OVERLAY CONTROLS =====
function showOverlay(id, audioSrc, duration, delay) {
    const overlay = document.getElementById(id);
    overlay.classList.add('show');

    if (overlayTimeouts[id]) {
        clearTimeout(overlayTimeouts[id]);
        delete overlayTimeouts[id];
    }

    if (id === 'overlayWelcome') {
        const gif = document.getElementById('welcomeGif');
        gif.classList.add('hidden-gif');
        gif.classList.remove('show-gif');

        if (welcomeGifTimeout) {
            clearTimeout(welcomeGifTimeout);
            welcomeGifTimeout = null;
        }

        welcomeGifTimeout = setTimeout(() => {
            gif.classList.remove('hidden-gif');
            void gif.offsetWidth;
            gif.classList.add('show-gif');
        }, DELAY_WELCOME_GIF);
    }

    if (audioSrc) {
        if (delay && delay > 0) {
            if (welcomeVoiceTimeout) {
                clearTimeout(welcomeVoiceTimeout);
                welcomeVoiceTimeout = null;
            }
            welcomeVoiceTimeout = setTimeout(() => {
                playAudio(audioSrc);
                isWelcomeVoicePlaying = true;
            }, delay);
        } else {
            setTimeout(() => {
                playAudio(audioSrc);
            }, 300);
        }
    }

    if (duration && duration > 0) {
        overlayTimeouts[id] = setTimeout(() => {
            closeOverlay(id);
        }, duration);
    }
}

function closeOverlay(id) {
    const overlay = document.getElementById(id);
    overlay.classList.remove('show');

    if (id === 'overlayWelcome') {
        stopAudio();
        const gif = document.getElementById('welcomeGif');
        gif.classList.add('hidden-gif');
        gif.classList.remove('show-gif');
        if (welcomeGifTimeout) {
            clearTimeout(welcomeGifTimeout);
            welcomeGifTimeout = null;
        }
    } else {
        stopAudio();
    }

    if (overlayTimeouts[id]) {
        clearTimeout(overlayTimeouts[id]);
        delete overlayTimeouts[id];
    }
}

// ===== POPUP SYSTEM =====
function showPopup(type, title, message, callback) {
    const overlay = document.getElementById('customPopup');
    const icon = document.getElementById('popupIcon');
    const titleEl = document.getElementById('popupTitle');
    const messageEl = document.getElementById('popupMessage');
    const button = document.getElementById('popupButton');

    icon.className = 'popup-icon';
    button.className = 'popup-btn';

    switch (type) {
        case 'success':
            icon.classList.add('success');
            icon.innerHTML = '<i class="ri-check-line"></i>';
            button.classList.add('success-btn');
            button.textContent = 'Lanjutkan';
            break;
        case 'error':
            icon.classList.add('error');
            icon.innerHTML = '<i class="ri-close-circle-line"></i>';
            button.classList.add('error-btn');
            button.textContent = 'Coba Lagi';
            break;
        case 'warning':
            icon.classList.add('warning');
            icon.innerHTML = '<i class="ri-alert-line"></i>';
            button.classList.add('warning-btn');
            button.textContent = 'OK';
            break;
        case 'info':
            icon.classList.add('info');
            icon.innerHTML = '<i class="ri-information-line"></i>';
            button.classList.add('primary');
            button.textContent = 'OK';
            break;
        default:
            icon.classList.add('success');
            icon.innerHTML = '<i class="ri-check-line"></i>';
            button.classList.add('primary');
            button.textContent = 'OK';
    }

    titleEl.textContent = title;
    messageEl.textContent = message;
    overlay.classList.add('active');

    button.onclick = function () {
        overlay.classList.remove('active');
        if (callback) callback();
    };
    overlay.onclick = function (e) {
        if (e.target === overlay) {
            overlay.classList.remove('active');
            if (callback) callback();
        }
    };
    document.addEventListener('keydown', function escHandler(e) {
        if (e.key === 'Escape') {
            overlay.classList.remove('active');
            document.removeEventListener('keydown', escHandler);
            if (callback) callback();
        }
    });
}

// ===== FUNGSI KUIS =====
let step1Submitted = false;
let selectedModality = null;

function submitJawaban() {
    const form = document.getElementById('formKuis');
    const formData = new FormData(form);

    // Cek apakah semua soal sudah dijawab
    const total_soal = document.querySelectorAll('.question-card').length;
    const soal_terjawab = new Set();

    formData.forEach((value, key) => {
        if (key.startsWith('jawaban[')) {
            soal_terjawab.add(key);
        }
    });

    if (soal_terjawab.size < total_soal) {
        showPopup('warning', 'Perhatian', 'Silahkan jawab semua soal terlebih dahulu!');
        return;
    }

    // Ubah status tombol
    const btnSubmit = document.getElementById('btnSubmitSoal');
    btnSubmit.textContent = 'Memproses...';
    btnSubmit.disabled = true;

    // Kirim data ke backend (Laravel)
    fetch("/siswa/tes-kognitif/simpan", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            step1Submitted = true;

            // REACTION OVERLAY
            stopAudio();
            const audioSrc = data.jumlah_benar >= 10 ? '/sound/nilai-bagus.mp3' : '/sound/nilai-lumayan.mp3';
            showOverlay('overlayReaction', audioSrc, DURATION_REACTION);

            // Tampilkan Rekomendasi AI
            document.getElementById('ai-rekomendasi').classList.remove('hidden');
            document.getElementById('ai-rekomendasi').scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Teks Rekomendasi
                       // Teks Rekomendasi
            let pesan = '';
            if (data.label === 'High Cognitive') {
                pesan = `Hebat! Kamu menjawab ${data.jumlah_benar} dari ${data.total_soal} soal dengan benar (${data.nilai}%). Pemahamanmu sangat baik! Pertahankan semangat belajarmu! 💪`;
            } else {
                pesan = `Kamu menjawab ${data.jumlah_benar} dari ${data.total_soal} soal dengan benar (${data.nilai}%). Jangan menyerah! Pelajari kembali materi yang masih kurang dipahami. Semangat! 💪`;
            }

            document.getElementById('ai-text').textContent = pesan;


            // Sembunyikan tombol dan update indikator
            btnSubmit.style.display = 'none';
            document.getElementById('dot1').classList.remove('active');
            document.getElementById('dot1').classList.add('done');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showPopup('error', 'Gagal', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        btnSubmit.textContent = 'Submit Jawaban';
        btnSubmit.disabled = false;
    });
}

function selectModality(el) {
    document.querySelectorAll('#step2 .modality-card').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    selectedModality = el.getAttribute('data-modality');

    // ===== MODALITY REACTION OVERLAY =====
    stopAudio();
    let audioSrc = '';
    if (selectedModality === 'visual') {
        audioSrc = '/sound/modality-visual.mp3';
    } else if (selectedModality === 'auditory') {
        audioSrc = '/sound/modality-auditory.mp3';
    } else if (selectedModality === 'reading') {
        audioSrc = '/sound/modality-reading.mp3';
    }
    showOverlay('overlayVisual', audioSrc, DURATION_VISUAL);

    document.getElementById('btnFinish').disabled = false;
}

function goToStep2() {
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
    document.getElementById('dot2').classList.add('active');
}

function goToStep1() {
    document.getElementById('step1').classList.remove('hidden');
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('dot2').classList.remove('active');
    if (!step1Submitted) document.getElementById('dot1').classList.add('active');
}

function finish() {
    if (!selectedModality) {
        showPopup('warning', 'Perhatian', 'Silahkan pilih learning modalities terlebih dahulu!');
        return;
    }
    const modalityNames = { visual: 'Visual', auditory: 'Auditory', reading: 'Reading' };
    showPopup('success', 'Selamat! 🎉', `Kamu telah menyelesaikan semua tahap Learning Modalities dengan pilihan ${modalityNames[selectedModality]}!`, function () {
        // Redirect ke route home siswa
        window.location.href = '/siswa/home';
    });
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        const step1 = !document.getElementById('step1').classList.contains('hidden');
        const step2 = !document.getElementById('step2').classList.contains('hidden');
        if (step1 && !step1Submitted) submitJawaban();
        else if (step1 && step1Submitted) goToStep2();
        else if (step2 && selectedModality) finish();
    }
});

// ===== INIT =====
document.addEventListener('DOMContentLoaded', () => {
    // Tampilkan overlay pembuka
    showOverlay('overlayWelcome', '/sound/welcome-voice.mp3', DURATION_WELCOME, DELAY_WELCOME_VOICE);
});
