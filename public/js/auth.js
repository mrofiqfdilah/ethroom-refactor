function togglePassword() {
    var input = document.getElementById('password');
    var icon = document.getElementById('eye-icon');
    if (input && icon) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'ri-eye-off-line text-xl';
        } else {
            input.type = 'password';
            icon.className = 'ri-eye-line text-xl';
        }
    }
}

function handleRoleChange() {
    var roleElement = document.getElementById('role');
    if (!roleElement) return;

    var role = roleElement.value;
    var identityLabel = document.getElementById('identityLabel');
    var nipInput = document.getElementById('nip');
    var nisnInput = document.getElementById('nisn');
    var kelasContainer = document.getElementById('kelasContainer');
    var idKelas = document.getElementById('id_kelas');

    if (!identityLabel || !nipInput || !nisnInput || !kelasContainer || !idKelas) return;

    if (role === 'Siswa') {
        identityLabel.textContent = 'NISN';
        identityLabel.setAttribute('for', 'nisn');

        // Sembunyikan & nonaktifkan NIP
        nipInput.classList.add('hidden');
        nipInput.disabled = true;
        nipInput.required = false;
        nipInput.value = '';          // reset nilai NIP

        // Tampilkan & aktifkan NISN
        nisnInput.classList.remove('hidden');
        nisnInput.disabled = false;
        nisnInput.required = true;

        // Tampilkan kelas
        kelasContainer.classList.remove('hidden');
        idKelas.disabled = false;
        idKelas.required = true;
    } else {
        identityLabel.textContent = 'NIP';
        identityLabel.setAttribute('for', 'nip');

        // Sembunyikan & nonaktifkan NISN
        nisnInput.classList.add('hidden');
        nisnInput.disabled = true;
        nisnInput.required = false;
        nisnInput.value = '';         // reset nilai NISN

        // Tampilkan & aktifkan NIP
        nipInput.classList.remove('hidden');
        nipInput.disabled = false;
        nipInput.required = true;

        // Sembunyikan kelas
        kelasContainer.classList.add('hidden');
        idKelas.disabled = true;
        idKelas.required = false;
        idKelas.value = '';
    }
}

function selectGender(gender) {
    document.querySelectorAll('.gender-option').forEach(function (el) {
        el.classList.remove('selected');
    });

    var target = gender === 'Laki-laki'
        ? document.getElementById('label-male')
        : document.getElementById('label-female');

    if (target) {
        target.classList.add('selected');
        target.querySelector('input[type="radio"]').checked = true;
    }
}

function loadKelas() {
    var idSekolahElement = document.getElementById('id_sekolah');
    if (!idSekolahElement) return;

    var idSekolah = idSekolahElement.value;
    var idKelasSelect = document.getElementById('id_kelas');
    if (!idKelasSelect) return;

    var oldKelas = idKelasSelect.dataset.old;

    idKelasSelect.innerHTML = '<option value="">-- Pilih Kelas --</option>';

    if (!idSekolah) return;

    fetch(`/api/sekolah/${idSekolah}/kelas`)
        .then(function (response) { return response.json(); })
        .then(function (data) {
            data.forEach(function (kelas) {
                var option = document.createElement('option');
                option.value = kelas.id;
                option.textContent = kelas.nama_kelas;
                if (oldKelas && String(kelas.id) === String(oldKelas)) {
                    option.selected = true;
                }
                idKelasSelect.appendChild(option);
            });
        })
        .catch(function (error) { console.error('Error fetching kelas:', error); });
}

['nip', 'nisn'].forEach(function (id) {
    var el = document.getElementById(id);
    if (el) {
        el.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    handleRoleChange();

    var idSekolahElement = document.getElementById('id_sekolah');
    if (idSekolahElement && idSekolahElement.value) {
        loadKelas();
    }
});
