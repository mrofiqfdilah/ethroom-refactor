<!-- navbar.html -->
<nav class="app-navbar bg-white/95 backdrop-blur-sm shadow-sm border-b border-[#ac6700]/20 sticky top-0 z-50
    w-full" style="position: sticky; top: 0;">
    <div class="container-custom">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center gap-4 group cursor-pointer">
                <a href="index.html" class="flex items-center gap-4">
                    <div class="nav-logo transition-transform duration-300 group-hover:scale-110 group-hover:rotate-6"
                        style="width: 50px; height: 50px;">
                        <img src="{{ asset('images/auth-logo.png') }}" alt="ETH ROOM Logo" />
                    </div>
                    <div class="nav-brand hidden sm:block">
                        <h1 class="text-xl font-extrabold tracking-wider leading-tight transition-colors duration-300 group-hover:text-[#ac6700]"
                            style="font-family: 'Exo 2', sans-serif; color:  #1f7a3d;">
                            ETH ROOM<span style="color: #ac6700;">.</span>
                        </h1>
                        <p class="text-xs text-[#6a4c2f]/70 leading-tight max-w-xs">Ruang belajar Digital</p>
                    </div>
                    <div class="nav-brand block sm:hidden">
                        <h1 class="text-xl font-extrabold tracking-wider leading-tight transition-colors duration-300 group-hover:text-[#ac6700]"
                            style="font-family: 'Exo 2', sans-serif; color:#005b1a; position: relative; left: -10px; top:3px;">
                            ETH ROOM<span style="color: #ac6700;">.</span>
                        </h1>
                    </div>
                </a>
            </div>
            <div class="flex items-center gap-3 sm:gap-5 relative">
                <!-- Notification -->
                <div class="relative flex items-center cursor-pointer" id="notifButton">
                    <i
                        class="ri-notification-3-line text-2xl text-[#ac6700] hover:text-[#8a5200] transition-colors"></i>
                    <span id="notifBadge"
                        class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white badge-notif"></span>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" id="profileDropdown">
                    <div class="w-11 h-11 rounded-full overflow-hidden border-2 border-[#005b1a]/60 flex-shrink-0 cursor-pointer hover:border-[#005b1a] transition-colors"
                        onclick="toggleDropdown()">
                        <img src="images/fotosiswa1.png" alt="Profile" class="w-full h-full object-cover" />
                    </div>
                    <div id="dropdownMenu"
                        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl py-2 z-50 border border-gray-100/50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-stone-800">Andi Pratama</p>
                            <p class="text-xs text-stone-500">andi@gmail.com</p>
                        </div>
                        <div class="py-1">
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-stone-700 hover:bg-amber-50 hover:text-[#8a5200]">
                                <i class="ri-user-line text-lg text-[#ac6700]"></i> Profil Saya
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-stone-700 hover:bg-amber-50 hover:text-[#8a5200]">
                                <i class="ri-question-line text-lg text-[#ac6700]"></i> Bantuan
                            </a>
                        </div>
                        <div class="border-t border-gray-100 py-1">
                            <button onclick="handleLogout()"
                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 w-full">
                                <i class="ri-logout-box-r-line text-lg"></i> Keluar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>


<script>
    function initNavbar() {
    // DROPDOWN
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        if (menu) menu.classList.toggle('hidden');
    }
    window.toggleDropdown = toggleDropdown; // biar bisa dipanggil dari onclick di HTML

    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('profileDropdown');
        const menu = document.getElementById('dropdownMenu');
        if (dropdown && menu && !dropdown.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });

    window.handleLogout = function () {
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            window.location.href = 'login.html';
        }
    };
}
</script>
