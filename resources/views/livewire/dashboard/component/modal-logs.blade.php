<div x-cloak x-show="showModal" x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" @click.self="closeModal()"
    @keydown.escape.window="closeModal()">

    <div x-show="showModal" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        class="bg-white dark:bg-gray-900 rounded-xl shadow-xl w-full max-w-2xl mx-4 max-h-[80vh] overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Riwayat Pengingat</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400" x-text="activityName"></p>
            </div>
            <button @click="closeModal()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="px-6 py-4 overflow-y-auto max-h-[60vh]">
            <!-- Loading -->
            <div x-show="loading" class="text-center py-8">
                <svg class="w-8 h-8 mx-auto animate-spin text-blue-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Memuat data...</p>
            </div>

            <!-- Logs List -->
            <div x-show="!loading && logs.length > 0" class="space-y-3">
                <template x-for="(log, index) in logs" :key="index">
                    <div
                        class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-sm font-medium text-gray-900 dark:text-white"
                                    x-text="log.number"></span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400" x-text="log.created_at"></span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300" x-text="log.message"></p>
                    </div>
                </template>
            </div>

            <!-- Empty State -->
            <div x-show="!loading && logs.length === 0" class="text-center py-8">
                <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-gray-500 dark:text-gray-400">Belum ada riwayat pengingat untuk kegiatan ini.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
            <button @click="closeModal()"
                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                Tutup
            </button>
        </div>
    </div>
</div>
