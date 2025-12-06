<div x-show="activeTab === 'periode'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">Data Periode</h2>
            <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola periode kegiatan tahunan</p>
        </div>

        <!-- Button Tambah Periode -->
        <button @click="$dispatch('open-modal-periode')"
            class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center justify-center gap-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Periode
        </button>
    </div>

    <!-- Table Data Periode -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Nama</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Tanggal Mulai</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Tanggal Selesai</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Status</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <!-- Contoh Data -->
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <td class="py-3 px-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Tahun Akademik 2023/2024</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="text-sm text-gray-900 dark:text-gray-100">1 Agustus 2023</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="text-sm text-gray-900 dark:text-gray-100">31 Juli 2024</div>
                    </td>
                    <td class="py-3 px-4">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            bg-green-100 text-green-800 
                            dark:bg-green-900 dark:text-green-200">
                            <span class="w-2 h-2 rounded-full bg-green-500 dark:bg-green-300 mr-1.5"></span>
                            Aktif
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-2">
                            <button
                                @click="$dispatch('open-modal-periode', {
                                id: 1,
                                name: 'Tahun Akademik 2023/2024',
                                start_date: '2023-08-01',
                                end_date: '2024-07-31',
                                status: 'active'
                            })"
                                class="text-blue-600 hover:text-blue-800 p-1.5 hover:bg-blue-50 rounded-lg transition-colors 
                                       dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button
                                class="text-red-600 hover:text-red-800 p-1.5 hover:bg-red-50 rounded-lg transition-colors 
                                       dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Contoh Data 2 -->
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <td class="py-3 px-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Tahun Akademik 2022/2023</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="text-sm text-gray-900 dark:text-gray-100">1 Agustus 2022</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="text-sm text-gray-900 dark:text-gray-100">31 Juli 2023</div>
                    </td>
                    <td class="py-3 px-4">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            bg-gray-100 text-gray-800 
                            dark:bg-gray-700 dark:text-gray-200">
                            <span class="w-2 h-2 rounded-full bg-gray-500 dark:bg-gray-400 mr-1.5"></span>
                            Tidak Aktif
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-2">
                            <button
                                @click="$dispatch('open-modal-periode', {
                                id: 2,
                                name: 'Tahun Akademik 2022/2023',
                                start_date: '2022-08-01',
                                end_date: '2023-07-31',
                                status: 'inactive'
                            })"
                                class="text-blue-600 hover:text-blue-800 p-1.5 hover:bg-blue-50 rounded-lg transition-colors 
                                       dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button
                                class="text-red-600 hover:text-red-800 p-1.5 hover:bg-red-50 rounded-lg transition-colors 
                                       dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @include('livewire.master-data.component.modal-form-periode')
</div>
