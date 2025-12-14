<div x-show="activeTab === 'periode'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">

    <div class="mb-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">Data Periode</h2>
        <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola periode kegiatan tahunan</p>
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
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($periods as $period)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="py-3 px-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $period->name }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                {{ $period->start_date->format('d F Y') }}
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                {{ $period->end_date->format('d F Y') }}
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @if ($period->status)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    <span class="w-2 h-2 rounded-full bg-green-500 dark:bg-green-300 mr-1.5"></span>
                                    Aktif
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                    <span class="w-2 h-2 rounded-full bg-gray-500 dark:bg-gray-400 mr-1.5"></span>
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Belum ada data periode</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <x-global.pagination :paginator="$periods" />
</div>
