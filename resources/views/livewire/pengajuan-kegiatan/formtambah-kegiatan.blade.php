<div x-data="formKegiatan" class="bg-white dark:bg-gray-800 p-4 sm:p-6">

    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="/pengajuan-kegiatan" wire:navigate
                class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tambah Pengajuan Kegiatan</h2>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400 ml-8">
            Periode Aktif: <span class="font-medium">{{ $activePeriod?->name ?? 'Tidak ada periode aktif' }}</span>
        </p>
    </div>

    {{-- Error General --}}
    @error('general')
        <div
            class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </div>
    @enderror

    <form wire:submit="save" class="space-y-6">
        {{-- Section 1: Organization Search --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">1. Pilih Organisasi</h3>

            <div class="relative">
                <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Cari Nama Organisasi</label>
                <div class="relative">
                    <input type="text" x-model="searchQuery" @input.debounce.300ms="search()"
                        @focus="showDropdown = true" @click.away="showDropdown = false" wire:model="searchOrganization"
                        placeholder="Ketik nama organisasi..."
                        class="w-full px-3 py-2 pl-9 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <div x-show="loading" class="absolute right-2.5 top-2.5">
                        <svg class="animate-spin h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>

                {{-- Dropdown Results --}}
                <div x-show="showDropdown && results.length > 0" x-cloak
                    class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded shadow-lg max-h-48 overflow-y-auto">
                    <template x-for="org in results" :key="org.id">
                        <button type="button" @click="selectOrg(org)"
                            class="w-full px-3 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-600 border-b border-gray-200 dark:border-gray-600 last:border-b-0">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-200" x-text="org.name"></div>
                            <div class="text-xs text-gray-500 dark:text-gray-400" x-text="org.lembaga"></div>
                        </button>
                    </template>
                </div>

                {{-- No results --}}
                <div x-show="showDropdown && searchQuery.length >= 2 && results.length === 0 && !loading" x-cloak
                    class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded shadow-lg p-3 text-center text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada organisasi ditemukan
                </div>
            </div>

            @error('searchOrganization')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror

            {{-- Wallet Info --}}
            @if ($walletInfo)
                <div
                    class="mt-4 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border border-emerald-200 dark:border-emerald-800/50 rounded-xl overflow-hidden">
                    {{-- Header --}}
                    <div
                        class="px-4 py-3 bg-emerald-100/50 dark:bg-emerald-900/30 border-b border-emerald-200 dark:border-emerald-800/50">
                        <div class="flex items-center gap-2">
                            <div class="p-1.5 bg-emerald-500 dark:bg-emerald-600 rounded-lg">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h4 class="text-sm font-semibold text-emerald-900 dark:text-emerald-100">Informasi Rekening
                            </h4>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            {{-- Bank Info --}}
                            <div class="flex items-start gap-3">
                                <div
                                    class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-emerald-100 dark:border-emerald-800/50">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="text-[10px] uppercase tracking-wider font-semibold text-emerald-600 dark:text-emerald-500">
                                        Bank</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $walletInfo->bank_name ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Account Name --}}
                            <div class="flex items-start gap-3">
                                <div
                                    class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-emerald-100 dark:border-emerald-800/50">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="text-[10px] uppercase tracking-wider font-semibold text-emerald-600 dark:text-emerald-500">
                                        Nama Rekening</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $walletInfo->account_name }}</p>
                                </div>
                            </div>

                            {{-- Account Number --}}
                            <div class="flex items-start gap-3">
                                <div
                                    class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-emerald-100 dark:border-emerald-800/50">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p
                                        class="text-[10px] uppercase tracking-wider font-semibold text-emerald-600 dark:text-emerald-500">
                                        No. Rekening</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white font-mono">
                                        {{ $walletInfo->account_number }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Balance Section --}}
                        <div class="mt-4 pt-4 border-t border-emerald-200 dark:border-emerald-800/50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-emerald-500 dark:bg-emerald-600 rounded-lg">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-emerald-700 dark:text-emerald-300">Saldo
                                        Tersedia</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                                        Rp {{ number_format($walletInfo->balance, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Section 2: Proposal --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">2. Data Proposal</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">File Proposal <span
                            class="text-red-500">*</span></label>
                    <input type="file" wire:model="proposalFile" accept=".pdf,.doc,.docx"
                        class="w-full text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/40 dark:file:text-blue-300">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Format: PDF, DOC, DOCX (Max 10MB)</p>
                    @error('proposalFile')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Dana Disetujui <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                        <input type="text" x-model="displayFunds" @input="formatFunds($event.target.value)"
                            placeholder="0"
                            class="w-full px-3 py-2 pl-10 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    @if ($walletInfo)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Maks: Rp
                            {{ number_format($walletInfo->balance, 0, ',', '.') }}</p>
                    @endif
                    @error('fundsApproved')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Tanggal Diterima <span
                            class="text-red-500">*</span></label>
                    <input type="date" wire:model="dateReceived"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('dateReceived')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Section 3: Activity --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">3. Detail Kegiatan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Nama Kegiatan <span
                            class="text-red-500">*</span></label>
                    <input type="text" wire:model="activityName" placeholder="Masukkan nama kegiatan"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('activityName')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai <span
                            class="text-red-500">*</span></label>
                    <input type="date" wire:model="startDate" x-model="startDate"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('startDate')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Tanggal Selesai <span
                            class="text-red-500">*</span></label>
                    <div class="flex items-center gap-2">
                        <input type="date" wire:model="endDate" x-model="endDate"
                            class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <template x-if="startDate && endDate">
                            <span :class="getActivityStatus().class" class="px-2 py-1 text-xs font-medium rounded"
                                x-text="getActivityStatus().text"></span>
                        </template>
                    </div>
                    @error('endDate')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Lokasi <span
                            class="text-red-500">*</span></label>
                    <input type="text" wire:model="location" placeholder="Masukkan lokasi kegiatan"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('location')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Penanggung Jawab <span
                            class="text-red-500">*</span></label>
                    <input type="text" wire:model="personResponsible" placeholder="Nama penanggung jawab"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    @error('personResponsible')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">No. WhatsApp <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500 dark:text-gray-400 text-sm">+62</span>
                        <input type="text" wire:model="numberPr" placeholder="8xxxxxxxxxx"
                            class="w-full px-3 py-2 pl-12 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    @error('numberPr')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                    <textarea wire:model="description" rows="3" placeholder="Deskripsi kegiatan (opsional)"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Section 4: Expense & Tax --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">4. Pengeluaran & Pajak</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Bukti Pengeluaran</label>

                    {{-- Hidden File Input --}}
                    <input type="file" wire:model="proofFile" accept=".jpg,.jpeg,.png" class="sr-only"
                        id="proof-file-kegiatan">

                    {{-- Upload Box - Show when no file --}}
                    @if (!$proofFile)
                        <label for="proof-file-kegiatan" wire:loading.class="hidden" wire:target="proofFile"
                            class="flex flex-col items-center justify-center w-full py-5 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 hover:border-blue-400 dark:hover:border-blue-500 transition-all duration-200 group">
                            <svg class="w-8 h-8 mb-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p
                                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-500 transition-colors">
                                <span class="font-semibold">Klik untuk upload</span>
                            </p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">JPG, PNG (Max. 5MB)</p>
                        </label>
                    @endif

                    {{-- Loading Indicator --}}
                    <div wire:loading wire:target="proofFile"
                        class="w-full py-6 border-2 border-blue-300 dark:border-blue-600 rounded-lg bg-blue-50 dark:bg-blue-900/30">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="animate-spin h-8 w-8 text-blue-500 mb-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">Mengupload file...</p>
                        </div>
                    </div>

                    {{-- Image Preview - Filament Style --}}
                    @if ($proofFile)
                        <div wire:loading.remove wire:target="proofFile">
                            <div
                                class="flex items-center gap-3 w-full p-3 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700">
                                {{-- Thumbnail --}}
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-16 h-16 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-800">
                                        <img src="{{ $proofFile->temporaryUrl() }}"
                                            class="w-full h-full object-cover" alt="Preview">
                                    </div>
                                </div>
                                {{-- File Info --}}
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $proofFile->getClientOriginalName() }}
                                    </p>
                                    <p
                                        class="text-xs text-green-600 dark:text-green-400 flex items-center gap-1 mt-0.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Siap diupload
                                    </p>
                                </div>
                                {{-- Remove Button --}}
                                <button type="button" wire:click="$set('proofFile', null)"
                                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    @error('proofFile')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Jenis Pajak <span
                            class="text-red-500">*</span></label>
                    <select wire:model="taxType" x-model="taxType"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="PPh22">PPh22 - 1,5%</option>
                        <option value="PPh23">PPh23 - 2%</option>
                        <option value="Ppn">PPN - 12%</option>
                    </select>
                    @error('taxType')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tax Calculation Info --}}
            <template x-if="fundsApproved > 0">
                <div
                    class="mt-3 p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded">
                    <div class="flex items-center justify-between text-sm">
                        <div>
                            <p class="font-medium text-amber-800 dark:text-amber-300">Kalkulasi Pajak</p>
                            <p class="text-xs text-amber-600 dark:text-amber-400"
                                x-text="taxType + ' (' + getTaxPercentage() + '%)'">
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-amber-800 dark:text-amber-300"
                                x-text="'Rp ' + formatCurrency(getTaxAmount())"></p>
                            <p class="text-xs text-amber-600 dark:text-amber-400"
                                x-text="'dari Rp ' + formatCurrency(fundsApproved)"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Submit Button --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <a href="/pengajuan-kegiatan" wire:navigate
                class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                Batal
            </a>
            <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                class="px-4 py-2 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded flex items-center gap-2">
                <span wire:loading.remove wire:target="save">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
                <span wire:loading wire:target="save">
                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
                <span wire:loading.remove wire:target="save">Simpan Pengajuan</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>

@script
    <script>
        Alpine.data('formKegiatan', () => ({
            searchQuery: '',
            results: [],
            showDropdown: false,
            loading: false,

            // Notification
            notification: {
                show: false,
                type: '',
                message: ''
            },

            // Data untuk kalkulasi
            fundsApproved: @js($fundsApproved ?? 0),
            displayFunds: @js($fundsApproved ? number_format($fundsApproved, 0, ',', '.') : ''),
            taxType: @js($taxType ?? 'PPh22'),
            startDate: @js($startDate ?? ''),
            endDate: @js($endDate ?? ''),

            // Format funds input with dots
            formatFunds(value) {
                let num = value.replace(/\D/g, '');
                if (num === '') {
                    this.displayFunds = '';
                    this.fundsApproved = 0;
                    $wire.set('fundsApproved', null);
                    return;
                }
                this.fundsApproved = parseInt(num);
                this.displayFunds = new Intl.NumberFormat('id-ID').format(parseInt(num));
                $wire.set('fundsApproved', parseInt(num));
            },

            async search() {
                if (this.searchQuery.length < 2) {
                    this.results = [];
                    return;
                }

                this.loading = true;
                try {
                    this.results = await $wire.searchOrganizations(this.searchQuery);
                } catch (error) {
                    console.error('Search error:', error);
                    this.results = [];
                } finally {
                    this.loading = false;
                }
            },

            selectOrg(org) {
                this.searchQuery = org.name;
                this.showDropdown = false;
                this.results = [];
                $wire.selectOrganization(org.id);
            },

            // Tax percentage calculation
            getTaxPercentage() {
                const rates = {
                    'PPh22': 1.5,
                    'PPh23': 2,
                    'Ppn': 12
                };
                return rates[this.taxType] || 0;
            },

            getTaxAmount() {
                return this.fundsApproved * (this.getTaxPercentage() / 100);
            },

            // Activity status calculation
            getActivityStatus() {
                if (!this.startDate || !this.endDate) {
                    return {
                        text: '-',
                        class: 'bg-gray-100 text-gray-800'
                    };
                }

                const now = new Date();
                now.setHours(0, 0, 0, 0);

                const start = new Date(this.startDate);
                start.setHours(0, 0, 0, 0);

                const end = new Date(this.endDate);
                end.setHours(23, 59, 59, 999);

                if (start > now) {
                    return {
                        text: 'Belum Dimulai',
                        class: 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200'
                    };
                }

                if (now >= start && now <= end) {
                    return {
                        text: 'Berlangsung',
                        class: 'bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300'
                    };
                }

                return {
                    text: 'Selesai',
                    class: 'bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300'
                };
            },

            // Format currency helper
            formatCurrency(value) {
                return new Intl.NumberFormat('id-ID').format(value);
            }
        }));
    </script>
@endscript
