<!-- MODAL DETAIL PENGGUNAAN DANA - MODERN & LEBAR -->
<div id="detailModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <!-- Overlay dengan animasi fade -->
    <div id="detailModalOverlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-all duration-500 ease-out opacity-0"></div>

    <!-- Modal Content -->
    <div class="flex min-h-full items-center justify-center p-4">
        <!-- Container dengan animasi -->
        <div id="detailModalContainer"
            class="relative w-full max-w-5xl transition-all duration-500 ease-out transform opacity-0 translate-y-8">
            <!-- Modal Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header Modern -->
                <div
                    class="px-8 py-6 bg-gradient-to-r from-blue-500/10 via-blue-400/10 to-blue-600/10 dark:from-blue-900/30 dark:via-blue-800/30 dark:to-blue-900/30 border-b border-blue-200/50 dark:border-blue-800/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-file-invoice-dollar text-white text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    Detail Pengeluaran
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Informasi lengkap transaksi pengeluaran
                                </p>
                            </div>
                        </div>
                        <button onclick="closeDetailModal()"
                            class="p-2.5 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all duration-200 hover:rotate-90">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Body - LAYOUT HORIZONTAL -->
                <div class="p-8">
                    <!-- Grid 2 Kolom untuk Desktop, 1 Kolom untuk Mobile -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- KOLOM KIRI -->
                        <div class="space-y-6">
                            <!-- Card Lembaga -->
                            <div
                                class="bg-gradient-to-r from-blue-50/80 to-blue-100/50 dark:from-blue-900/20 dark:to-blue-800/20 border border-blue-200/50 dark:border-blue-800/30 rounded-xl p-5 hover:shadow-md transition-all duration-300 min-h-[140px]">
                                <div class="h-full flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                        <i class="fas fa-building text-white text-lg"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                            Lembaga</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Universitas Teknologi Indonesia
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Jumlah -->
                            <div
                                class="bg-gradient-to-r from-amber-50/80 to-amber-100/50 dark:from-amber-900/20 dark:to-amber-800/20 border border-amber-200/50 dark:border-amber-800/30 rounded-xl p-5 hover:shadow-md transition-all duration-300 min-h-[140px]">
                                <div class="h-full flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                        <i class="fas fa-money-bill-wave text-white text-lg"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jumlah</p>
                                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                            Rp 12.500.000
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Dua belas juta lima ratus ribu rupiah
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Pajak -->
                            <div
                                class="bg-gradient-to-r from-red-50/80 to-red-100/50 dark:from-red-900/20 dark:to-red-800/20 border border-red-200/50 dark:border-red-800/30 rounded-xl p-5 hover:shadow-md transition-all duration-300 min-h-[140px]">
                                <div class="h-full flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                        <i class="fas fa-percentage text-white text-lg"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pajak</p>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-2xl font-bold text-gray-900 dark:text-white">11%</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                    Nilai: Rp 1.375.000
                                                </p>
                                            </div>
                                            <span
                                                class="px-3 py-1.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-semibold rounded-full flex-shrink-0">
                                                PPN
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KOLOM KANAN -->
                        <div class="space-y-6">
                            <!-- Card Kegiatan -->
                            <div
                                class="bg-gradient-to-r from-emerald-50/80 to-emerald-100/50 dark:from-emerald-900/20 dark:to-emerald-800/20 border border-emerald-200/50 dark:border-emerald-800/30 rounded-xl p-5 hover:shadow-md transition-all duration-300 min-h-[140px]">
                                <div class="h-full flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                        <i class="fas fa-calendar-alt text-white text-lg"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                            Kegiatan</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Seminar Nasional Teknologi 2024
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Tanggal -->
                            <div
                                class="bg-gradient-to-r from-purple-50/80 to-purple-100/50 dark:from-purple-900/20 dark:to-purple-800/20 border border-purple-200/50 dark:border-purple-800/30 rounded-xl p-5 hover:shadow-md transition-all duration-300 min-h-[140px]">
                                <div class="h-full flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                        <i class="fas fa-calendar-day text-white text-lg"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                            Pengeluaran</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            15 Maret 2024
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex items-center">
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Bukti Pembayaran - DISAMAKAN DENGAN LAINNYA -->
                            <div
                                class="bg-gradient-to-r from-indigo-50/80 to-indigo-100/50 dark:from-indigo-900/20 dark:to-indigo-800/20 border border-indigo-200/50 dark:border-indigo-800/30 rounded-xl p-5 hover:shadow-md transition-all duration-300 min-h-[140px]">
                                <div class="h-full flex flex-col">
                                    <div class="flex items-start gap-4 mb-4 flex-shrink-0">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-md flex-shrink-0">
                                            <i class="fas fa-file-invoice-dollar text-white text-lg"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Bukti
                                                Pembayaran</p>
                                            <div class="flex items-center justify-between">
                                                <span
                                                    class="text-gray-600 dark:text-gray-400 flex items-center text-sm">
                                                    <i class="fas fa-file-image mr-2 text-indigo-500"></i>
                                                    brimo.jpg
                                                </span>
                                                <span
                                                    class="text-xs text-gray-500 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded flex-shrink-0">
                                                    <i class="fas fa-image mr-1"></i>
                                                    Gambar
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tombol di bagian bawah card -->
                                    <div class="mt-auto">
                                        <button onclick="openImagePreview('/images/brimo.jpg', 'brimo.jpg')"
                                            class="w-auto px-3 py-1.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg text-sm font-medium transition-all duration-300 hover:scale-[1.02] hover:shadow-lg active:scale-95 flex items-center justify-center group">
                                            <i
                                                class="fas fa-eye text-sm mr-1.5 group-hover:scale-110 transition-transform"></i>
                                            Lihat Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Total - Full Width -->
                    <div class="mt-8">
                        <div
                            class="bg-gradient-to-r from-gray-900 to-gray-800 dark:from-gray-800 dark:to-gray-900 rounded-xl p-6 shadow-lg">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div class="mb-4 md:mb-0">
                                    <p class="text-sm font-medium text-gray-300 dark:text-gray-400 mb-2">Ringkasan
                                        Pembayaran</p>
                                    <p class="text-3xl font-bold text-white">
                                        Rp 13.875.000
                                    </p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                        <i class="fas fa-check-circle mr-1 text-green-400"></i>
                                        Sudah termasuk semua biaya dan pajak
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 gap-4 md:w-1/3">
                                    <div class="text-center p-3 bg-white/5 rounded-lg">
                                        <p class="text-xs text-gray-400 dark:text-gray-500">Subtotal</p>
                                        <p class="text-lg font-semibold text-white">Rp 12.500.000</p>
                                    </div>
                                    <div class="text-center p-3 bg-white/5 rounded-lg">
                                        <p class="text-xs text-gray-400 dark:text-gray-500">Pajak (11%)</p>
                                        <p class="text-lg font-semibold text-red-400">+ Rp 1.375.000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Modern -->
                <div
                    class="px-8 py-5 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-gray-100/50 dark:from-gray-900/30 dark:to-gray-800/30">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2 mb-4 md:mb-0">
                        </div>
                        <div class="flex gap-3">
                            <button onclick="closeDetailModal()"
                                class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-medium transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                <i class="fas fa-check mr-2"></i>
                                Selesai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Animasi untuk modal detail */
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

    /* Untuk tombol Lihat Foto */
    #lihatFotoBtn {
        padding: 0.625rem 1.5rem;
        font-size: 0.875rem;
    }
</style>

<script>
    // =============================================
    // FUNGSI UNTUK MODAL DETAIL
    // =============================================

    function openDetailModal() {
        const modal = document.getElementById('detailModal');
        const overlay = document.getElementById('detailModalOverlay');
        const container = document.getElementById('detailModalContainer');

        modal.classList.remove('hidden');
        overlay.classList.remove('overlay-exit');
        container.classList.remove('modal-exit');

        void modal.offsetWidth;

        overlay.classList.add('overlay-enter');
        overlay.style.opacity = '1';

        setTimeout(() => {
            container.classList.add('modal-enter');
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);

        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        const overlay = document.getElementById('detailModalOverlay');
        const container = document.getElementById('detailModalContainer');

        container.classList.remove('modal-enter');
        container.classList.add('modal-exit');
        overlay.classList.remove('overlay-enter');
        overlay.classList.add('overlay-exit');

        setTimeout(() => {
            modal.classList.add('hidden');
            container.classList.remove('modal-exit');
            container.style.transform = 'translateY(8px)';
            container.style.opacity = '0';
            overlay.classList.remove('overlay-exit');
            overlay.style.opacity = '0';
            document.body.style.overflow = 'auto';
        }, 400);
    }

    // =============================================
    // EVENT LISTENERS
    // =============================================

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Cek modal detail
            if (!document.getElementById('detailModal').classList.contains('hidden')) {
                closeDetailModal();
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const detailOverlay = document.getElementById('detailModalOverlay');
        if (detailOverlay) {
            detailOverlay.addEventListener('click', closeDetailModal);
        }
    });

    // =============================================
    // FUNGSI GLOBAL
    // =============================================
    window.openDetailModal = openDetailModal;
    window.closeDetailModal = closeDetailModal;
</script>
