<div x-data="kegiatanData()" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div
        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">

        <!-- Header Section -->
        <div
            class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-white dark:from-gray-800 dark:to-gray-900">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Kegiatan Sedang Berlangsung</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Daftar kegiatan yang aktif saat ini</p>
                </div>
                <div class="flex items-center gap-3">
                    <span
                        class="px-4 py-2 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg text-sm font-semibold border border-green-200 dark:border-green-800 flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span x-text="kegiatanBerlangsung.length + ' Aktif'"></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Kegiatan Cards Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                <template x-for="kegiatan in kegiatanBerlangsung" :key="kegiatan.id">
                    <div
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-5 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-300 group">

                        <!-- Header Card -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-calendar-check text-white text-lg"></i>
                                </div>
                                <div>
                                    <span
                                        class="px-2.5 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-md text-xs font-semibold border border-green-200 dark:border-green-800">
                                        <i class="fas fa-circle text-green-500 text-xs mr-1 animate-pulse"></i>
                                        <span x-text="kegiatan.status"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Nama Kegiatan -->
                        <h3 class="font-bold text-gray-900 dark:text-gray-100 text-lg mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors"
                            x-text="kegiatan.nama"></h3>

                        <!-- Info Details -->
                        <div class="space-y-3 mb-4">

                            <!-- Lembaga -->
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-building text-purple-600 dark:text-purple-300 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Lembaga</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100"
                                        x-text="kegiatan.lembaga"></p>
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 bg-amber-100 dark:bg-amber-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-amber-600 dark:text-amber-300 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Periode</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100"
                                        x-text="kegiatan.tanggal"></p>
                                </div>
                            </div>

                            <!-- Penanggung Jawab -->
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user-tie text-blue-600 dark:text-blue-300 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Penanggung Jawab</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100"
                                        x-text="kegiatan.penanggungJawab"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div
                            class="pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                <i class="far fa-clock"></i>
                                <span x-text="kegiatan.hariTersisa"></span>
                            </div>
                        </div>

                    </div>
                </template>
            </div>

            <!-- Empty State -->
            <template x-if="kegiatanBerlangsung.length === 0">
                <div class="text-center py-16">
                    <div
                        class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-times text-gray-400 dark:text-gray-500 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Tidak Ada Kegiatan Aktif
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Belum ada kegiatan yang sedang berlangsung saat
                        ini</p>
                </div>
            </template>
        </div>
    </div>
</div>
