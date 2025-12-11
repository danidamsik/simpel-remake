<div x-data="{
    open: false,
    selectedActivity: null,
    formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    },
    formatMoney(amount) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(amount || 0);
    },
    getStatus(start, end) {
        const now = new Date();
        now.setHours(0, 0, 0, 0); // Compare dates only
        const startDate = new Date(start);
        startDate.setHours(0, 0, 0, 0);
        const endDate = new Date(end);
        endDate.setHours(23, 59, 59, 999); // Include the entire end day

        if (startDate > now) return { text: 'Belum Dimulai', class: 'bg-gray-100 text-gray-800' };
        if (now >= startDate && now <= endDate) return { text: 'Berlangsung', class: 'bg-blue-100 text-blue-800' };
        return { text: 'Selesai', class: 'bg-green-100 text-green-800' };
    }
}"
    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg dark:shadow-gray-900/20 transition-colors my-24">
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
                    <select wire:model.live="lembagaFilter"
                        class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none appearance-none bg-white">
                        <option value="">Semua Lembaga</option>
                        @foreach ($lembagas as $lembaga)
                            <option value="{{ $lembaga }}">{{ $lembaga }}</option>
                        @endforeach
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
                    <select wire:model.live="periodId"
                        class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none appearance-none bg-white">
                        <option value="">Semua Periode</option>
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}">{{ $period->name }}</option>
                        @endforeach
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
                    <select wire:model.live="lpjStatus"
                        class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none appearance-none bg-white">
                        <option value="">Semua Status</option>
                        <option value="Belum Disetor">Belum Disetor</option>
                        <option value="Disetujui">Disetujui</option>
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
                    <input type="text" placeholder="Cari kegiatan..." wire:model.live.debounce.300ms="search"
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
                            Total Pengeluaran</th>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Status LPJ</th>
                        <th
                            class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($activities as $activity)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                        <span
                                            class="text-sm font-medium text-blue-600 dark:text-blue-300">{{ substr($activity->organization->name ?? '?', 0, 2) }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $activity->organization->name }}</span>
                                        <span
                                            class="text-xs text-gray-500 dark:text-gray-400">{{ $activity->organization->lembaga }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-4">
                                <span
                                    class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $activity->name }}</span>
                                <div class="text-xs text-gray-500">{{ $activity->location }}</div>
                            </td>

                            <td class="py-4 px-4">
                                <span
                                    class="text-sm text-gray-900 dark:text-gray-200">{{ $activity->proposal->date_received ? $activity->proposal->date_received->format('d M Y') : '-' }}</span>
                            </td>

                            <td class="py-4 px-4">
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Rp
                                    {{ number_format($activity->proposal->funds_approved, 0, ',', '.') }}</span>
                            </td>

                            <td class="py-4 px-4">
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-200">Rp
                                    {{ number_format($activity->expenses_sum_amount, 0, ',', '.') }}</span>
                            </td>

                            <td class="py-4 px-4">
                                @php
                                    $statusColor = $activity->lpj?->status == 'Disetujui' ? 'green' : 'yellow';
                                    $statusLabel = $activity->lpj?->status ?? 'Belum Ada';
                                @endphp
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium bg-{{ $statusColor }}-100 dark:bg-{{ $statusColor }}-900/30 text-{{ $statusColor }}-800 dark:text-{{ $statusColor }}-300">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center gap-1">
                                    <button @click="selectedActivity = {{ Js::from($activity) }}; open = true"
                                        class="p-2 text-blue-600 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                                        title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data kegiatan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                {{ $activities->links('livewire.pengajuan-kegiatan.pagination') }}
            </div>
        </div>
    </div>
    @include('livewire.pengajuan-kegiatan.detail-modal')
</div>
