<div x-show="$wire.showAddModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true">
    {{-- Backdrop --}}
    <div x-show="$wire.showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="$wire.showAddModal = false"></div>

    {{-- Modal Panel --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="$wire.showAddModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative w-full max-w-lg transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-2xl transition-all">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Transaksi
                    </h3>
                    <button @click="$wire.showAddModal = false"
                        class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-5 space-y-5 max-h-[70vh] overflow-y-auto">
                {{-- Flash Messages --}}
                @if (session()->has('error'))
                    <div
                        class="p-3 bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-300 rounded-lg text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Activity Search (Full Width) --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Pilih Kegiatan <span class="text-red-500">*</span>
                    </label>

                    {{-- Selected Activity Display --}}
                    <div x-show="$wire.selectedActivity"
                        class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-700 rounded-lg p-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white"
                                    x-text="$wire.selectedActivity?.name"></p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"
                                    x-text="$wire.selectedActivity?.organization?.name + ' - ' + $wire.selectedActivity?.organization?.lembaga">
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1"
                                    x-text="'Periode: ' + ($wire.selectedActivity?.period?.name || '-')"></p>
                            </div>
                            <button @click="$wire.clearSelectedActivity()" type="button"
                                class="text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Wallet Information Display --}}
                    <div x-show="$wire.selectedWallet" x-transition
                        class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/50 rounded-xl p-4 shadow-sm">
                        <div
                            class="flex items-center gap-3 mb-3 pb-2 border-b border-emerald-100 dark:border-emerald-800/50">
                            <div
                                class="p-2 bg-emerald-100 dark:bg-emerald-800/50 rounded-lg text-emerald-600 dark:text-emerald-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-emerald-900 dark:text-emerald-100">Informasi Wallet
                                </h4>
                                <p
                                    class="text-[10px] text-emerald-600 dark:text-emerald-400 font-medium uppercase tracking-wider">
                                    Sumber Dana Organisasi</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-y-3 gap-x-4">
                            <div>
                                <p
                                    class="text-[10px] text-emerald-600 dark:text-emerald-500 uppercase font-bold mb-0.5">
                                    Bank / Akun</p>
                                <p class="text-xs font-semibold text-gray-900 dark:text-white"
                                    x-text="($wire.selectedWallet?.bank_name || '-') + ' / ' + ($wire.selectedWallet?.account_name || '-')">
                                </p>
                            </div>
                            <div>
                                <p
                                    class="text-[10px] text-emerald-600 dark:text-emerald-500 uppercase font-bold mb-0.5">
                                    Nomor Rekening</p>
                                <p class="text-xs font-semibold text-gray-900 dark:text-white"
                                    x-text="$wire.selectedWallet?.account_number || '-'"></p>
                            </div>
                            <div class="col-span-2 mt-1">
                                <p class="text-[10px] text-emerald-600 dark:text-emerald-500 uppercase font-bold mb-1">
                                    Saldo Tersedia</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400">Rp</span>
                                    <span
                                        class="text-lg font-black text-emerald-700 dark:text-emerald-300 tracking-tight"
                                        x-text="Number($wire.selectedWallet?.balance || 0).toLocaleString('id-ID')"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Wallet Search Warning --}}
                    <div x-show="$wire.selectedActivity && !$wire.selectedWallet" x-transition
                        class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700/50 rounded-xl p-4 flex items-center gap-3">
                        <div class="text-amber-600 dark:text-amber-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-amber-900 dark:text-amber-100">Wallet Belum Tersedia
                            </p>
                            <p class="text-xs text-amber-600 dark:text-amber-400">Pastikan wallet organisasi untuk
                                periode
                                ini sudah dibuat.</p>
                        </div>
                    </div>

                    {{-- Search Input --}}
                    <div x-show="!$wire.selectedActivity" x-data="{
                        search: '',
                        results: [],
                        loading: false,
                        async searchActivities() {
                            if (this.search.length < 2) {
                                this.results = [];
                                return;
                            }
                            this.loading = true;
                            this.results = await $wire.searchActivities(this.search);
                            this.loading = false;
                        }
                    }" @click.outside="results = []"
                        class="relative">
                        <div class="relative">
                            <input type="text" x-model="search" @input.debounce.300ms="searchActivities()"
                                placeholder="Cari kegiatan yang sedang berjalan..."
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl py-2.5 pl-10 pr-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 outline-none text-gray-900 dark:text-gray-100 shadow-sm transition-all" />
                            <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>

                            {{-- Loading indicator --}}
                            <div x-show="loading" class="absolute right-3 top-3">
                                <svg class="animate-spin h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        {{-- Search Results --}}
                        <div x-show="results.length > 0" x-transition
                            class="absolute z-50 w-full mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg max-h-60 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700">
                            <template x-for="activity in results" :key="activity.id">
                                <button type="button"
                                    @click="$wire.selectActivity(activity); search = ''; results = [];"
                                    class="w-full px-4 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <p class="font-medium text-gray-900 dark:text-white text-sm"
                                        x-text="activity.name"></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400"
                                        x-text="activity.organization.name + ' - ' + activity.organization.lembaga">
                                    </p>
                                </button>
                            </template>
                        </div>

                        <div x-show="search.length >= 2 && results.length === 0 && !loading"
                            class="absolute z-50 w-full mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg p-4 text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada
                                kegiatan yang sedang berjalan ditemukan.</p>
                        </div>
                    </div>

                    @error('selectedActivity')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Two Column Layout --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Left Column --}}
                    <div class="space-y-5">
                        {{-- Amount (Masked) --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Jumlah (Bruto) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <span
                                    class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400 font-medium group-focus-within:text-blue-500 transition-colors">Rp</span>
                                <input type="text" x-model="displayAmount"
                                    class="w-full border outline-none border-gray-300 dark:border-gray-600 rounded-xl py-2.5 pl-10 pr-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 transition-all shadow-sm"
                                    placeholder="0" />
                            </div>
                            @error('amount')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Expense Date --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Tanggal Pengeluaran <span class="text-red-500">*</span>
                            </label>
                            <input type="date" wire:model="expenseDate"
                                class="w-full border outline-noneborder-gray-300 dark:border-gray-600 rounded-xl py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all" />
                            @error('expenseDate')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-5">
                        {{-- Tax Type & Percentage (Info) --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Jenis
                                    Pajak</label>
                                <select wire:model="taxType"
                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-xl py-2.5 outline-none px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm shadow-sm transition-all cursor-pointer">
                                    <option value="PPh22">PPh 22</option>
                                    <option value="PPh23">PPh 23</option>
                                    <option value="Ppn">PPN</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Persentase</label>
                                <div
                                    class="flex items-center h-[42px] w-full px-4 rounded-xl bg-blue-50 dark:bg-blue-900/40 border border-blue-100 dark:border-blue-800 text-blue-700 dark:text-blue-300 font-medium text-sm">
                                    <span x-text="$wire.taxPersentase"></span>%
                                </div>
                            </div>
                        </div>

                        {{-- Proof File --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Bukti
                                Transaksi</label>
                            <div class="relative">
                                <input type="file" wire:model="proofFile" accept=".jpg,.jpeg,.png,.pdf"
                                    class="block w-full text-xs text-gray-500 dark:text-gray-400
                                file:mr-3 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-xs file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100 active:file:bg-blue-200
                                dark:file:bg-blue-900/30 dark:file:text-blue-400
                                cursor-pointer file:cursor-pointer file:transition-colors" />
                            </div>
                            @error('proofFile')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Summary Card --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                    <h4
                        class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 border-b border-gray-200 dark:border-gray-600 pb-2">
                        Rincian Perhitungan</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Jumlah Bruto</span>
                            <span class="font-medium text-gray-900 dark:text-white">Rp <span
                                    x-text="(parseFloat($wire.amount) || 0).toLocaleString('id-ID')"></span></span>
                        </div>
                        <div class="flex justify-between items-center text-red-600 dark:text-red-400">
                            <span>Potongan Pajak (<span x-text="$wire.taxPersentase + '%'"></span>)</span>
                            <span class="font-medium">- Rp <span
                                    x-text="taxAmount.toLocaleString('id-ID')"></span></span>
                        </div>
                        <div
                            class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-600">
                            <span class="font-bold text-gray-800 dark:text-white">Jumlah Bersih (Net)</span>
                            <span class="font-bold text-green-600 dark:text-green-400 text-lg">Rp <span
                                    x-text="netAmount.toLocaleString('id-ID')"></span></span>
                        </div>
                    </div>
                </div>

                {{-- Description (Full Width) --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea wire:model="description" rows="2"
                        class="w-full border outline-none border-gray-300 dark:border-gray-600 rounded-lg py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 resize-none"
                        placeholder="Keterangan pengeluaran..."></textarea>
                </div>
            </div>

            {{-- Footer --}}
            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex justify-end gap-3">
                <button type="button" @click="$wire.showAddModal = false"
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Batal
                </button>
                <button type="button" wire:click="saveExpense" wire:loading.attr="disabled"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                    <svg wire:loading wire:target="saveExpense" class="animate-spin h-4 w-4" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span wire:loading.remove wire:target="saveExpense">Simpan Transaksi</span>
                    <span wire:loading wire:target="saveExpense">Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>
</div>
