{{-- Modal Kegiatan --}}
<div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-6">

    <!-- Modal Box -->
    <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="w-full max-w-5xl bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden"
        @click.away="closeModal()">

        <!-- Header -->
        <div
            class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Kegiatan Organisasi
                </h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Organisasi:</span>
                    <span x-text="orgName" class="text-sm font-medium text-blue-600 dark:text-blue-400"></span>
                </div>
            </div>

            <button @click="closeModal()"
                class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Body -->
        <div
            class="px-6 py-4 max-h-[70vh] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-gray-100 dark:scrollbar-track-gray-800">

            <!-- Loading State -->
            @include('components.global.loading')

            <!-- Empty State -->
            <template x-if="!loading && activities.length === 0">
                <div class="text-center py-12">
                    <div
                        class="w-16 h-16 mx-auto rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                        <i class="fas fa-inbox text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Tidak ada kegiatan
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada kegiatan yang tercatat untuk
                        lembaga ini</p>
                </div>
            </template>

            <!-- Table -->
            <template x-if="!loading && activities.length > 0">
                <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="w-full">
                        <thead class="bg-gray-100 dark:bg-gray-900">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Nama Kegiatan
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Mulai
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Selesai
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Lokasi
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Dana
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase">
                                    Status LPJ
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            <template x-for="(activity, index) in activities" :key="index">
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-4 py-3">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white"
                                            x-text="activity.activity_name"></span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="text-sm">
                                            <div class="text-gray-900 dark:text-white"
                                                x-text="formatDate(activity.start_date)"></div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="text-sm">
                                            <div class="text-gray-900 dark:text-white"
                                                x-text="formatDate(activity.end_date)"></div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="text-sm text-gray-700 dark:text-gray-300"
                                            x-text="activity.location || '-'"></span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="text-sm font-medium text-red-600 dark:text-red-400">
                                            Rp <span
                                                x-text="new Intl.NumberFormat('id-ID').format(activity.funds_used)"></span>
                                        </span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <template x-if="activity.lpj_status === 'Disetujui'">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                                <span x-text="activity.lpj_status"></span>
                                            </span>
                                        </template>
                                        <template x-if="activity.lpj_status === 'Belum Disetor'">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                                <span x-text="activity.lpj_status"></span>
                                            </span>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>
    </div>
</div>
