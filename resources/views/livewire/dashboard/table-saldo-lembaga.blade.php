<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div
        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header Section -->
        <div
            class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-900">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Ringkasan Saldo Lembaga</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Data keuangan dan status LPJ lembaga
                        mahasiswa</p>
                </div>
                <div class="flex items-center gap-3">
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <th
                            class="text-left py-4 px-6 font-semibold text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wider">
                            Lembaga
                        </th>
                        <th
                            class="text-left py-4 px-6 font-semibold text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wider">
                            Total Dana
                        </th>
                        <th
                            class="text-left py-4 px-6 font-semibold text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wider">
                            Dana Terpakai
                        </th>
                        <th
                            class="text-left py-4 px-6 font-semibold text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wider">
                            Dana Sekarang
                        </th>
                        <th
                            class="text-left py-4 px-6 font-semibold text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wider">
                            Status LPJ
                        </th>
                        <th
                            class="text-center py-4 px-6 font-semibold text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    <template x-for="lembaga in ringkasanLembaga" :key="lembaga.id">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            <!-- Nama Lembaga -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-sm flex-shrink-0">
                                        <i class="fas fa-university text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <span class="font-semibold text-gray-900 dark:text-gray-100 text-sm"
                                            x-text="lembaga.nama"></span>
                                    </div>
                                </div>
                            </td>

                            <!-- Total Dana -->
                            <td class="py-4 px-6">
                                <span class="font-semibold text-gray-900 dark:text-gray-100 text-sm"
                                    x-text="lembaga.totalDana"></span>
                            </td>

                            <!-- Dana Terpakai -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-arrow-down text-red-500 text-xs"></i>
                                    <span class="text-red-600 dark:text-red-400 font-semibold text-sm"
                                        x-text="lembaga.danaTerpakai"></span>
                                </div>
                            </td>

                            <!-- Saldo Tersisa -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-wallet text-green-500 text-xs"></i>
                                    <span class="text-green-600 dark:text-green-400 font-bold text-sm"
                                        x-text="lembaga.danaSekarang"></span>
                                </div>
                            </td>

                            <!-- Status LPJ -->
                            <td class="py-4 px-6">
                                <span
                                    :class="lembaga.statusLPJ === 'Lengkap' ?
                                        'bg-green-100 text-green-700 border border-green-200 dark:bg-green-900 dark:text-green-300 dark:border-green-700' :
                                        'bg-amber-100 text-amber-700 border border-amber-200 dark:bg-amber-900 dark:text-amber-300 dark:border-amber-700'"
                                    class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold">
                                    <i :class="lembaga.statusLPJ === 'Lengkap' ? 'fas fa-check-circle' : 'fas fa-clock'"
                                        class="mr-1.5 text-xs"></i>
                                    <span x-text="lembaga.statusLPJ"></span>
                                </span>
                            </td>

                            <!-- Action -->
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        class="px-4 py-2 bg-blue-50 dark:bg-blue-900 text-blue-600 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-lg transition-colors text-xs font-semibold flex items-center gap-1.5 border border-blue-200 dark:border-blue-700">
                                        <i class="fas fa-eye text-xs"></i>
                                        Detail
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
