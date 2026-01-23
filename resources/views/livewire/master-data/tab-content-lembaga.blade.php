<div x-show="activeTab === 'lembaga'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">

    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">Data Organisasi</h2>
            <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola informasi organisasi dan bendahara</p>
        </div>
        <button
            @click="
                $wire.name = '';
                $wire.lembaga = '';
                $wire.number_phone = '';
                $wire.email = '';
                $wire.logo = null;
                $wire.selectedUserId = '';
                $wire.bank_name = '';
                $wire.account_name = '';
                $wire.account_number = '';
                $wire.balance = 0;
                $wire.editMode = false;
                $wire.editingOrganizationId = null;
                $wire.existingOrganizationUserId = null;
                $wire.existingWalletId = null;
                $wire.existingLogoPath = null;
                $wire.showModal = true;
            "
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm text-sm font-medium transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Organisasi
        </button>
    </div>

    <!-- Filter Section -->
    <div class="mb-4 flex flex-col sm:flex-row gap-3">
        <!-- Search Input -->
        <div class="w-full sm:w-64">
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"
                    placeholder="Cari nama lembaga...">
            </div>
        </div>

        <!-- Filter Lembaga Type -->
        <div class="w-full sm:w-48">
            <select wire:model.live="filterLembaga"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                <option value="">Semua Fakultas</option>
                @foreach ($lembagaTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filter Period -->
        <div class="w-full sm:w-48">
            <select wire:model.live="filterPeriod"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                <option value="">Semua Periode</option>
                @foreach ($periods as $period)
                    <option value="{{ $period->id }}">{{ $period->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Table Data Lembaga -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Logo</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Nama</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Fakultas</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Bendahara</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Telepon</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Email</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Total Dana</th>
                    <th
                        class="py-3 px-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($organizations as $org)
                    @php
                        $colors = ['blue', 'green', 'purple', 'pink', 'indigo', 'teal', 'orange', 'red'];
                        $color = $colors[$loop->index % count($colors)];
                        $initial = strtoupper(substr($org->name, 0, 1));

                        $organizationUser = $org->organizationUsers->first(function ($ou) {
                            return !is_null($ou->wallet);
                        });
                        $treasurerName = $organizationUser->user->username ?? '-';
                        $walletBalance = $organizationUser->wallet->balance ?? 0;
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="py-3 px-4">
                            @if ($org->logo_path)
                                <img src="{{ asset('storage/' . $org->logo_path) }}" alt="{{ $org->name }}"
                                    class="h-10 w-10 rounded-lg object-cover">
                            @else
                                <div
                                    class="h-10 w-10 rounded-lg bg-gradient-to-br from-{{ $color }}-500 to-{{ $color }}-600 flex items-center justify-center">
                                    <span class="text-white font-bold">{{ $initial }}</span>
                                </div>
                            @endif
                        </td>

                        <td class="py-3 px-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $org->name }}</div>
                        </td>

                        <td class="py-3 px-4">
                            <span class="text-sm text-gray-900 dark:text-gray-100">
                                {{ $org->lembaga }}
                            </span>
                        </td>

                        <td class="py-3 px-4">
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                {{ $treasurerName }}
                            </div>
                        </td>

                        <td class="py-3 px-4">
                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $org->number_phone }}</div>
                        </td>

                        <td class="py-3 px-4">
                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $org->email }}</div>
                        </td>

                        <td class="py-3 px-4">
                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ 'Rp.' . number_format($walletBalance, 0, ',', '.') }}
                            </div>
                        </td>

                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Edit Button --}}
                                <button wire:click="edit({{ $org->id }})"
                                    class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <button wire:click="confirmDelete({{ $org->id }})"
                                    class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors"
                                    title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span>Belum ada data lembaga</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <x-global.pagination :paginator="$organizations" />
    @include('livewire.master-data.component.modal-form-lembaga')
    <x-global.confirm-modal title="Konfirmasi Hapus Lembaga"
        message="Apakah Anda yakin ingin menghapus lembaga ini? Data bendahara dan rekening terkait juga akan dihapus. Tindakan ini tidak dapat dibatalkan."
        confirmAction="delete" />
</div>
