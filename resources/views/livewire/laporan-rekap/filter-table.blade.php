<div class="bg-white dark:border-gray-700 dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Organisasi</label>
                <div class="relative">
                    <select wire:model.live="organization_id"
                        class="w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none text-sm bg-white cursor-pointer">
                        <option value="">Semua Organisasi</option>
                        @foreach ($organizations as $organization)
                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                        @endforeach
                    </select>
                    <i
                        class="fas fa-building absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                    <i
                        class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Status Kegiatan</label>
                <div class="relative">
                    <select wire:model.live="activity_status"
                        class="w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none text-sm bg-white cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="Belum Dimulai">Belum Dimulai</option>
                        <option value="Berlangsung">Berlangsung</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <i
                        class="fas fa-clipboard-list absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                    <i
                        class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Periode</label>
                <div class="relative">
                    <select wire:model.live="period_id"
                        class="w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none text-sm bg-white cursor-pointer">
                        <option value="">Semua Periode</option>
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}">{{ $period->name }}</option>
                        @endforeach
                    </select>
                    <i
                        class="fas fa-clock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                    <i
                        class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Status LPJ</label>
                <div class="relative">
                    <select wire:model.live="lpj_status"
                        class="w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none text-sm bg-white cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="Belum Disetor">Belum Disetor</option>
                        <option value="Disetujui">Disetujui</option>
                    </select>
                    <i
                        class="fas fa-file-invoice absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                    <i
                        class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <!-- Button Excel -->
                <button wire:click="exportExcel" wire:loading.attr="disabled" wire:target="exportExcel"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 disabled:bg-emerald-400 disabled:cursor-not-allowed text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                    <!-- Loading Spinner (hidden by default, shown when loading) -->
                    <svg wire:loading wire:target="exportExcel" class="animate-spin h-4 w-4 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <!-- Icon Excel (hidden when loading) -->
                    <i wire:loading.remove wire:target="exportExcel" class="fas fa-file-excel"></i>
                    <!-- Text -->
                    <span wire:loading.remove wire:target="exportExcel">Export Excel</span>
                    <span wire:loading wire:target="exportExcel">Mengunduh...</span>
                </button>

                <!-- Button PDF -->
                <button wire:click="exportPdf" wire:loading.attr="disabled" wire:target="exportPdf"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 disabled:bg-rose-400 disabled:cursor-not-allowed text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                    <!-- Loading Spinner (hidden by default, shown when loading) -->
                    <svg wire:loading wire:target="exportPdf" class="animate-spin h-4 w-4 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <!-- Icon PDF (hidden when loading) -->
                    <i wire:loading.remove wire:target="exportPdf" class="fas fa-file-pdf"></i>
                    <!-- Text -->
                    <span wire:loading.remove wire:target="exportPdf">Export PDF</span>
                    <span wire:loading wire:target="exportPdf">Mengunduh...</span>
                </button>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        No</th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Organisasi</th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Kegiatan</th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Tgl Mulai</th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Tgl Selesai</th>
                    <th
                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Dana Disetujui</th>
                    <th
                        class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Status Kegiatan</th>
                    <th
                        class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Status LPJ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                @forelse($data as $index => $item)
                    <tr class="hover:bg-blue-50/50 dark:hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 font-medium">
                            {{ $data->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item->organization_name }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 max-w-xs">
                            {{ $item->activity_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-gray-100 whitespace-nowrap">
                            Rp {{ number_format($item->funds_approved, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $now = now()->format('Y-m-d');
                                if ($item->start_date > $now) {
                                    $status = 'Belum Dimulai';
                                    $badgeClass = 'text-yellow-600 dark:text-yellow-500';
                                    $icon = 'fa-clock';
                                } elseif ($item->end_date < $now) {
                                    $status = 'Selesai';
                                    $badgeClass = 'text-emerald-600 dark:text-emerald-500';
                                    $icon = 'fa-check-circle';
                                } else {
                                    $status = 'Berlangsung';
                                    $badgeClass = 'text-blue-600 dark:text-blue-500';
                                    $icon = 'fa-spinner';
                                }
                            @endphp
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold {{ $badgeClass }}">
                                <i class="fas {{ $icon }}"></i>
                                {{ $status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($item->lpj_status == 'Disetujui')
                                <span
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-500">
                                    <i class="fas fa-check-double"></i>
                                    Disetujui
                                </span>
                            @elseif($item->lpj_status == 'Belum Disetor')
                                <span
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-rose-600 dark:text-rose-500">
                                    <i class="fas fa-times-circle"></i>
                                    Belum Disetor
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-minus"></i>
                                    -
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-300 dark:text-gray-600"></i>
                                <p class="text-base font-medium">Tidak ada data kegiatan</p>
                                <p class="text-sm mt-1">Coba sesuaikan filter pencarian Anda</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <x-global.pagination :paginator="$data" />
</div>
