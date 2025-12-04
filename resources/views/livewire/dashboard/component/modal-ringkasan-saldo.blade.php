<!-- MODAL KEGIATAN LEMBAGA -->
<div id="modalKegiatanLembaga" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <!-- Overlay dengan animasi fade -->
    <div id="modalOverlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-all duration-500 ease-out opacity-0"></div>

    <!-- Modal Content -->
    <div class="flex min-h-full items-center justify-center p-4">
        <!-- Container dengan animasi scale dan fade -->
        <div id="modalContainer"
            class="relative w-full max-w-6xl transition-all duration-500 ease-out transform opacity-0 translate-y-8">
            <!-- Modal Card - FULLY ROUNDED -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header dengan rounded top -->
                <div
                    class="px-8 py-6 bg-gradient-to-r from-blue-500/10 to-blue-600/10 dark:from-blue-900/30 dark:to-blue-800/30 border-b border-blue-200/50 dark:border-blue-800/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-university text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    Kegiatan Lembaga: <span class="text-blue-600 dark:text-blue-400">BEM
                                        Universitas</span>
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                    <i class="fas fa-list mr-2"></i>
                                    Semua kegiatan lembaga
                                </p>
                            </div>
                        </div>
                        <button onclick="closeModalKegiatan()"
                            class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all duration-200 hover:rotate-90">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-8 py-6 max-h-[65vh] overflow-y-auto modern-scrollbar">
                    <!-- Tabel Kegiatan -->
                    <div class="border border-gray-200/50 dark:border-gray-700/50 rounded-xl overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead
                                    class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900">
                                    <tr>
                                        <th class="px-6 py-4 text-left">
                                            <div
                                                class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                Nama Kegiatan
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div
                                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-play-circle text-green-500"></i>
                                                Mulai
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div
                                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-flag-checkered text-red-500"></i>
                                                Selesai
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div
                                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-map-marker-alt text-purple-500"></i>
                                                Lokasi
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div
                                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-money-bill-wave text-yellow-500"></i>
                                                Dana
                                            </div>
                                        </th>
                                        <th class="px-6 py-4 text-left">
                                            <div
                                                class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-file-invoice text-green-500"></i>
                                                Status LPJ
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                    <!-- Kegiatan 1 -->
                                    <tr
                                        class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-all duration-200">
                                        <td class="px-6 py-4">
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">
                                                    Seminar Kewirausahaan Mahasiswa
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                    <i class="fas fa-hashtag mr-1"></i>SEM-2023-001
                                                </p>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar text-green-500"></i>
                                                <div>
                                                    <p class="text-gray-900 dark:text-white">15 Okt 2023</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">09:00 WIB</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar-check text-red-500"></i>
                                                <div>
                                                    <p class="text-gray-900 dark:text-white">15 Okt 2023</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">16:00 WIB</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-map-marker-alt text-purple-500"></i>
                                                <div>
                                                    <p class="text-gray-900 dark:text-white">Auditorium Utama</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Kampus Pusat</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-money-bill-wave text-yellow-500"></i>
                                                <span class="font-semibold text-red-600 dark:text-red-400">
                                                    Rp 5.250.000
                                                </span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-green-100 to-green-50 text-green-800 dark:from-green-900/50 dark:to-green-800/50 dark:text-green-300 transition-all duration-200 hover:scale-105 hover:shadow-md">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                Lengkap
                                            </span>
                                        </td>

                                    </tr>

                                    <!-- Kegiatan 2 -->
                                    <tr
                                        class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-all duration-200">
                                        <td class="px-6 py-4">
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">
                                                    Pelatihan Public Speaking
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                    <i class="fas fa-hashtag mr-1"></i>PPS-2023-002
                                                </p>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar text-green-500"></i>
                                                <div>
                                                    <p class="text-gray-900 dark:text-white">22 Nov 2023</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">13:00 WIB</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar-check text-red-500"></i>
                                                <div>
                                                    <p class="text-gray-900 dark:text-white">23 Nov 2023</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">17:00 WIB</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-map-marker-alt text-purple-500"></i>
                                                <div>
                                                    <p class="text-gray-900 dark:text-white">Ruang Seminar FISIP</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">Fakultas Ilmu
                                                        Sosial</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-money-bill-wave text-yellow-500"></i>
                                                <span class="font-semibold text-red-600 dark:text-red-400">
                                                    Rp 3.800.000
                                                </span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800 dark:from-yellow-900/50 dark:to-yellow-800/50 dark:text-yellow-300 transition-all duration-200 hover:scale-105 hover:shadow-md">
                                                <i class="fas fa-clock mr-2 animate-pulse"></i>
                                                Dalam Proses
                                            </span>
                                        </td>

                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer - FULLY ROUNDED BOTTOM -->
                <div
                    class="px-8 py-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-900/30 dark:to-gray-800/30">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                            <i class="fas fa-info-circle text-blue-500"></i>
                            <span>Menampilkan 2 kegiatan lembaga</span>
                        </div>
                        <button onclick="closeModalKegiatan()"
                            class="px-5 py-2.5 bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-900 hover:to-black dark:from-gray-700 dark:to-gray-800 dark:hover:from-gray-800 dark:hover:to-gray-900 text-white rounded-xl font-medium text-sm transition-all duration-300 hover:scale-105 hover:shadow-lg active:scale-95">
                            <i class="fas fa-times mr-2"></i>
                            Tutup Modal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Ultra Modern Scrollbar */
    .modern-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #3b82f6 #f8fafc;
    }

    .modern-scrollbar::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    .modern-scrollbar::-webkit-scrollbar-track {
        background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        margin: 4px;
    }

    .modern-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 10px;
        border: 2px solid #f8fafc;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modern-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.5);
        transform: scale(1.05);
    }

    .modern-scrollbar::-webkit-scrollbar-thumb:active {
        background: linear-gradient(180deg, #1d4ed8 0%, #1e3a8a 100%);
    }

    .modern-scrollbar::-webkit-scrollbar-corner {
        background: transparent;
    }

    /* Dark Mode Scrollbar */
    .dark .modern-scrollbar {
        scrollbar-color: #60a5fa #1e293b;
    }

    .dark .modern-scrollbar::-webkit-scrollbar-track {
        background: linear-gradient(180deg, #1e293b 0%, #334155 100%);
        border: 2px solid #334155;
    }

    .dark .modern-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #60a5fa 0%, #3b82f6 100%);
        border: 2px solid #1e293b;
        box-shadow: 0 2px 8px rgba(96, 165, 250, 0.3);
    }

    .dark .modern-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #3b82f6 0%, #2563eb 100%);
        box-shadow: 0 4px 12px rgba(96, 165, 250, 0.5);
    }

    /* Animasi khusus */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOutDown {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(20px);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    .modal-enter {
        animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .modal-exit {
        animation: fadeOutDown 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .overlay-enter {
        animation: fadeIn 0.3s ease-out forwards;
    }

    .overlay-exit {
        animation: fadeOut 0.3s ease-out forwards;
    }
</style>

<script>
    // Fungsi untuk membuka modal dengan animasi premium
    function openModalKegiatan() {
        const modal = document.getElementById('modalKegiatanLembaga');
        const overlay = document.getElementById('modalOverlay');
        const container = document.getElementById('modalContainer');

        // Tampilkan modal
        modal.classList.remove('hidden');

        // Reset state untuk animasi
        overlay.classList.remove('overlay-exit');
        container.classList.remove('modal-exit');

        // Trigger reflow
        void modal.offsetWidth;

        // Jalankan animasi overlay
        overlay.classList.add('overlay-enter');
        overlay.style.opacity = '1';

        // Jalankan animasi container dengan delay
        setTimeout(() => {
            container.classList.add('modal-enter');
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);

        document.body.style.overflow = 'hidden';
    }

    // Fungsi untuk menutup modal dengan animasi premium
    function closeModalKegiatan() {
        const modal = document.getElementById('modalKegiatanLembaga');
        const overlay = document.getElementById('modalOverlay');
        const container = document.getElementById('modalContainer');

        // Jalankan animasi keluar
        container.classList.remove('modal-enter');
        container.classList.add('modal-exit');

        overlay.classList.remove('overlay-enter');
        overlay.classList.add('overlay-exit');

        // Sembunyikan modal setelah animasi selesai
        setTimeout(() => {
            modal.classList.add('hidden');
            // Reset transform untuk next open
            container.classList.remove('modal-exit');
            container.style.transform = 'translateY(8px)';
            container.style.opacity = '0';
            overlay.classList.remove('overlay-exit');
            overlay.style.opacity = '0';

            document.body.style.overflow = 'auto';
        }, 500);
    }

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModalKegiatan();
        }
    });

    // Close modal ketika klik overlay
    document.getElementById('modalOverlay').addEventListener('click', function(e) {
        closeModalKegiatan();
    });
</script>
