<div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg dark:shadow-gray-900/20 transition-colors my-24">
    <!-- Filter Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Daftar Proposal</h2>
            <div class="flex items-center gap-4">
                <button class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Tambah Kegiatan
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Filter: Nama Lembaga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lembaga</label>
                <div class="relative">
                    <select
                        class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none appearance-none bg-white">
                        <option value="">Semua Lembaga</option>
                        <option value="yayasan-peduli">Yayasan Peduli Bangsa</option>
                        <option value="forum-pemuda">Forum Pemuda Kreatif</option>
                        <option value="komunitas-seni">Komunitas Seni Nusantara</option>
                        <option value="lembaga-riset">Lembaga Riset Indonesia</option>
                    </select>
                    <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400 dark:text-gray-300 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Filter: Periode -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Periode</label>
                <div class="relative">
                    <select
                        class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none appearance-none bg-white">
                        <option value="">Semua Periode</option>
                        <option value="2024-Q1">2024 - Kuartal 1</option>
                        <option value="2024-Q2">2024 - Kuartal 2</option>
                        <option value="2024-Q3">2024 - Kuartal 3</option>
                        <option value="2024-Q4">2024 - Kuartal 4</option>
                    </select>
                    <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400 dark:text-gray-300 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Filter: Status LPJ -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status LPJ</label>
                <div class="relative">
                    <select
                        class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none appearance-none bg-white">
                        <option value="">Semua Status</option>
                        <option value="dikirim">LPJ Dikirim</option>
                        <option value="diterima">LPJ Diterima</option>
                        <option value="ditolak">LPJ Ditolak</option>
                        <option value="belum">Belum LPJ</option>
                    </select>
                    <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400 dark:text-gray-300 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Pencarian: Nama Kegiatan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pencarian Nama
                    Kegiatan</label>
                <div class="relative">
                    <input type="text" placeholder="Cari kegiatan..."
                        class="w-full px-4 py-3 pl-11 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
                    <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400 dark:text-gray-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px]">
                <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Nama Lembaga</th>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Nama Kegiatan</th>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Tanggal Diterima</th>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Dana Disetujui</th>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Status LPJ</th>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                    <span class="text-sm font-medium text-blue-600 dark:text-blue-300">YB</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Yayasan Bina
                                    Sejahtera</span>
                            </div>
                        </td>

                        <td class="py-4 px-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Pelatihan
                                Kewirausahaan</span>
                        </td>

                        <td class="py-4 px-4">
                            <span class="text-sm text-gray-900 dark:text-gray-200">15 Jan 2024</span>
                        </td>

                        <td class="py-4 px-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Rp 85.000.000</span>
                        </td>

                        <td class="py-4 px-4">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Dikirim
                            </span>
                        </td>

                        <td class="py-4 px-4">
                            <div class="flex items-center justify-center gap-1">
                                <button
                                    class="p-2 text-blue-600 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                                    title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                <button
                                    class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                <button
                                    class="p-2 text-red-600 dark:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                    title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center">
                                    <span class="text-sm font-medium text-purple-600 dark:text-purple-300">FK</span>
                                </div>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Forum Komunitas
                                    Seni</span>
                            </div>
                        </td>

                        <td class="py-4 px-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Pameran Seni
                                Kontemporer</span>
                        </td>

                        <td class="py-4 px-4">
                            <span class="text-sm text-gray-900 dark:text-gray-200">5 Feb 2024</span>
                        </td>

                        <td class="py-4 px-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Rp 120.000.000</span>
                        </td>

                        <td class="py-4 px-4">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Diterima
                            </span>
                        </td>

                        <td class="py-4 px-4">
                            <div class="flex items-center justify-center gap-1">
                                <button
                                    class="p-2 text-blue-600 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                                    title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>

                                <button
                                    class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                <button
                                    class="p-2 text-red-600 dark:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                    title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
