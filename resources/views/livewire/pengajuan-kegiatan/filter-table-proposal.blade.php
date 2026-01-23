<div x-data="proposalTable" @open-detail-modal.window="openModal($event.detail.id)"
    class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg dark:shadow-gray-900/20 transition-colors my-24">
    <!-- Filter Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Daftar Proposal</h2>
            <div class="flex items-center gap-4">
                <a href="/pengajuan-kegiatan/tambah-kegiatan" wire:navigate
                    class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Tambah Kegiatan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Filter: Nama Lembaga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fakultas</label>
                <div class="relative">
                    <select wire:model.live="lembagaFilter"
                        class="w-full px-4 py-3 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none appearance-none bg-white">
                        <option value="">Semua Fakultas</option>
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
                            Nama Organisasi</th>
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
                    @forelse($activities as $activity)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    @if ($activity->organization->logo_path)
                                        <img src="{{ asset('storage/' . $activity->organization->logo_path) }}"
                                            alt="{{ $activity->organization->name }}"
                                            class="w-8 h-8 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                            <span
                                                class="text-sm font-medium text-blue-600 dark:text-blue-300">{{ substr($activity->organization->name ?? '?', 0, 2) }}</span>
                                        </div>
                                    @endif
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
                                @php
                                    $statusLabel = $activity->lpj?->status ?? 'Belum Disetor';
                                @endphp
                                <span
                                    class="text-sm font-medium {{ $statusLabel == 'Disetujui' ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td class="py-4 px-4">
                                <div class="relative flex items-center justify-center" x-data="{ open: false }">
                                    <!-- 3-dot menu button -->
                                    <button @click="open = !open"
                                        class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                                        title="Opsi">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="5" r="2" />
                                            <circle cx="12" cy="12" r="2" />
                                            <circle cx="12" cy="19" r="2" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div x-show="open" @click.outside="open = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute top-full right-0 mt-1 w-44 bg-white dark:bg-gray-800 rounded-lg shadow-lg dark:shadow-gray-900/30 border border-gray-200 dark:border-gray-700 z-50"
                                        style="display: none;">
                                        <div class="py-1">
                                            <!-- Detail -->
                                            <button
                                                @click="open = false; $dispatch('open-detail-modal', { id: {{ $activity->id }} })"
                                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Detail
                                            </button>

                                            <!-- Edit -->
                                            <a href="{{ route('pengajuan-kegiatan.edit', $activity->id) }}"
                                                wire:navigate
                                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>

                                            <!-- Divider -->
                                            <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                                            <!-- Delete -->
                                            <button
                                                @click="open = false; $wire.showDeleteModal = true; $wire.deleteActivityId = {{ $activity->id }}"
                                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
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
        </div>
        <x-global.pagination :paginator="$activities" />
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-global.confirm-modal title="Konfirmasi Hapus"
        message="Apakah Anda yakin ingin menghapus kegiatan ini? Tindakan ini tidak dapat dibatalkan."
        confirmAction="deleteActivity" />

    @include('livewire.pengajuan-kegiatan.detail-modal')
</div>

@script
    <script>
        Alpine.data('proposalTable', () => ({
            open: false,
            selectedActivity: null,
            loading: false,

            init() {
                Livewire.on('lpj-uploaded', async (data) => {
                    if (this.selectedActivity && this.selectedActivity.id === data.activityId) {
                        this.selectedActivity = await $wire.getActivityDetails(data.activityId);
                    }
                });
            },

            async openModal(activityId) {
                this.selectedActivity = null;
                this.loading = true;
                this.open = true;

                try {
                    this.selectedActivity = await $wire.getActivityDetails(activityId);
                } catch (error) {
                    console.error('Error fetching activity details:', error);
                    this.open = false;
                } finally {
                    this.loading = false;
                }
            },

            closeModal() {
                this.open = false;
                this.selectedActivity = null;
                this.loading = false;
            },

            formatDate(dateString) {
                if (!dateString) return '-';

                try {
                    const date = new Date(dateString);
                    if (isNaN(date.getTime())) return '-';

                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    });
                } catch (error) {
                    console.error('Error formatting date:', error);
                    return '-';
                }
            },

            formatMoney(amount) {
                try {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(amount || 0);
                } catch (error) {
                    console.error('Error formatting money:', error);
                    return 'Rp 0';
                }
            },

            getStatus(start, end) {
                if (!start || !end) {
                    return {
                        text: '-',
                        class: 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200'
                    };
                }

                try {
                    const now = new Date();
                    now.setHours(0, 0, 0, 0);

                    const startDate = new Date(start);
                    startDate.setHours(0, 0, 0, 0);

                    const endDate = new Date(end);
                    endDate.setHours(23, 59, 59, 999);

                    if (startDate > now) {
                        return {
                            text: 'Belum Dimulai',
                            class: 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200'
                        };
                    }

                    if (now >= startDate && now <= endDate) {
                        return {
                            text: 'Berlangsung',
                            class: 'bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300'
                        };
                    }

                    return {
                        text: 'Selesai',
                        class: 'bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300'
                    };
                } catch (error) {
                    console.error('Error getting status:', error);
                    return {
                        text: '-',
                        class: 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200'
                    };
                }
            }
        }));
    </script>
@endscript
