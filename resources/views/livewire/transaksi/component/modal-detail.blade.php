<!-- MODAL DETAIL PENGGUNAAN DANA - MODERN & LEBAR -->
<div x-data="detailModal()" x-init="init()" @open-detail-modal.window="open()" @keydown.escape.window="close()"
    :class="{ 'hidden': !isOpen }" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">

    <!-- Overlay dengan animasi fade -->
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="close()"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>

    <!-- Modal Content -->
    <div class="flex min-h-full items-center justify-center p-4">
        <!-- Container dengan animasi -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 transform translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full max-w-5xl">
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
                        <button @click="close()"
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
                                    </div>
                                </div>
                            </div>

                            <!-- Card Bukti Pembayaran -->
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
                                        <button
                                            @click="$dispatch('open-image-preview', { 
                                                    imageUrl: '/images/brimo.jpg', 
                                                    fileName: 'brimo.jpg' 
                                                })"
                                            class="w-auto px-3 py-1.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg text-sm font-medium transition-all duration-300 hover:scale-[1.02] hover:shadow-lg active:scale-95 flex items-center justify-center group">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
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
                            <button @click="close()"
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

<script>
    function detailModal() {
        return {
            isOpen: false,

            init() {
                // Inisialisasi event listeners jika diperlukan
            },

            open() {
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },

            close() {
                this.isOpen = false;
                document.body.style.overflow = 'auto';
            }
        }
    }
</script>
