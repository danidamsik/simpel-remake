<div class="max-w-7xl mx-auto mb-8">
    <div
        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header Section -->
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">Daftar LPJ Terlambat</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Laporan yang melewati batas waktu pengumpulan
                    </p>
                </div>
                <span
                    class="px-3 py-1.5 bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 rounded-lg text-sm font-semibold">
                    <span x-text="lpjTerlambat.length"></span> Terlambat
                </span>
            </div>
        </div>

        <!-- LPJ List -->
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            <template x-for="lpj in lpjTerlambat" :key="lpj.id">
                <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <div class="flex items-start gap-4">
                        <!-- Icon -->
                        <div
                            class="w-12 h-12 bg-red-100 dark:bg-red-900/40 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-300 text-lg"></i>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-base mb-1"
                                        x-text="lpj.namaKegiatan"></h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300" x-text="lpj.namaLembaga"></p>
                                </div>
                                <span
                                    class="px-3 py-1 bg-red-600 dark:bg-red-700 text-white text-xs font-bold rounded-full whitespace-nowrap">
                                    <span x-text="lpj.terlambatHari"></span> hari
                                </span>
                            </div>

                            <p class="text-sm text-red-600 dark:text-red-400 mb-4">
                                <i class="fas fa-info-circle mr-1"></i>
                                Melebihi batas 2 minggu setelah selesai kegiatan
                            </p>

                            <!-- Actions -->
                            <div class="flex flex-wrap gap-2">
                                <button
                                    class="px-4 py-2 bg-green-600 dark:bg-green-700 text-white rounded-lg hover:bg-green-700 dark:hover:bg-green-800 transition-colors text-sm font-medium inline-flex items-center gap-2">
                                    <i class="fab fa-whatsapp"></i>
                                    Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <template x-if="lpjTerlambat.length === 0">
            <div class="p-12 text-center">
                <div
                    class="w-16 h-16 bg-green-100 dark:bg-green-900/40 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">Tidak Ada LPJ Terlambat</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Semua laporan telah diselesaikan tepat waktu</p>
            </div>
        </template>
    </div>
</div>
