<div x-show="showModal" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div @click="closeModal()"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-80 transition-opacity"
            aria-hidden="true"></div>

        <!-- Modal panel -->
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

            <!-- Loading State -->
            <div x-show="loading" class="p-8 flex items-center justify-center">
                <div class="flex flex-col items-center">
                    <svg class="animate-spin h-10 w-10 text-blue-600 dark:text-blue-400"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">Memuat data...</p>
                </div>
            </div>

            <!-- Content -->
            <div x-show="!loading && expenseDetail" class="bg-white dark:bg-gray-800 p-5">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Detail Transaksi</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5" x-text="expenseDetail?.expense_date">
                        </p>
                    </div>
                    <button @click="closeModal()" type="button"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Detail Content -->
                <div class="space-y-4 text-sm">
                    <!-- Organisasi & Kegiatan -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs text-gray-500 dark:text-gray-400 block mb-0.5">Organisasi</label>
                            <p class="font-semibold text-gray-900 dark:text-white"
                                x-text="expenseDetail?.organization_name"></p>
                            <p class="text-xs text-gray-600 dark:text-gray-400" x-text="expenseDetail?.lembaga_name">
                            </p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 dark:text-gray-400 block mb-0.5">Kegiatan</label>
                            <p class="font-medium text-gray-900 dark:text-white" x-text="expenseDetail?.activity_name">
                            </p>
                        </div>
                    </div>

                    <!-- Keuangan -->
                    <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                        <div class="space-y-1.5">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Jumlah</span>
                                <span class="font-medium text-gray-900 dark:text-white"
                                    x-text="expenseDetail?.amount"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Pajak (<span
                                        x-text="expenseDetail?.tax_persentase"></span>)</span>
                                <span class="font-medium text-gray-900 dark:text-white"
                                    x-text="expenseDetail?.tax_value"></span>
                            </div>
                            <div class="flex justify-between pt-1.5 border-t border-gray-200 dark:border-gray-700">
                                <span class="font-semibold text-gray-900 dark:text-white">Total</span>
                                <span class="font-bold text-blue-600 dark:text-blue-400"
                                    x-text="expenseDetail?.total"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Rekening -->
                    <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                        <label class="text-xs text-gray-500 dark:text-gray-400 block mb-1">Rekening</label>
                        <div class="space-y-0.5">
                            <p class="font-medium text-gray-900 dark:text-white" x-text="expenseDetail?.bank_name"></p>
                            <p class="text-gray-700 dark:text-gray-300" x-text="expenseDetail?.account_number"></p>
                            <p class="text-xs text-gray-600 dark:text-gray-400" x-text="expenseDetail?.account_name">
                            </p>
                        </div>
                    </div>

                    <!-- Bukti File -->
                    <div x-show="expenseDetail?.proof_file_url"
                        class="pt-3 border-t border-gray-200 dark:border-gray-700">
                        <button @click="openImageModal(expenseDetail?.proof_file_url)" type="button"
                            class="inline-flex items-center text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Lihat Bukti
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-5 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button @click="closeModal()" type="button"
                        class="w-full px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
