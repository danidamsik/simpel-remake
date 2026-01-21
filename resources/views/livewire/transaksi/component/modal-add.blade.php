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
            <div class="bg-gradient-to-r px-6 py-4"
                :class="$wire.isEditMode ? 'from-amber-500 to-amber-600' : 'from-blue-600 to-blue-700'">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <template x-if="!$wire.isEditMode">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </template>
                        <template x-if="$wire.isEditMode">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </template>
                        <span x-text="$wire.isEditMode ? 'Edit Transaksi' : 'Tambah Transaksi'"></span>
                    </h3>
                    <button @click="$wire.showAddModal = false; $wire.resetForm()"
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

                {{-- Activity Search (Full Width) --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <span x-text="$wire.isEditMode ? 'Kegiatan' : 'Pilih Kegiatan'"></span>
                        <span class="text-red-500" x-show="!$wire.isEditMode">*</span>
                    </label>

                    {{-- Selected Activity Display --}}
                    <div x-show="$wire.selectedActivity" class="border rounded-lg p-3"
                        :class="$wire.isEditMode ? 'bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600' :
                            'bg-blue-50 dark:bg-blue-900/30 border-blue-200 dark:border-blue-700'">
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
                            {{-- Only show clear button in add mode --}}
                            <button x-show="!$wire.isEditMode" @click="$wire.clearSelectedActivity()" type="button"
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

                    {{-- Search Input - Only show in add mode --}}
                    <div x-show="!$wire.selectedActivity && !$wire.isEditMode" x-data="{
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
                    }"
                        @click.outside="results = []" class="relative">
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

                {{-- Form Grid - 2 Columns --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Amount (Masked) --}}
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Jumlah (Bruto) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="absolute left-3 top-1.5 text-gray-500 dark:text-gray-400 font-medium group-focus-within:text-blue-500 transition-colors">Rp</span>
                            <input type="text" x-model="displayAmount"
                                class="w-full border outline-none border-gray-300 dark:border-gray-600 rounded-xl py-1.5 pl-10 pr-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 transition-all shadow-sm"
                                placeholder="0" />
                        </div>
                        @error('amount')
                            <span class="text-red-500 text-xs block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tax Type Combined --}}
                    <div class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Jenis Pajak</label>
                        <div class="flex rounded-xl shadow-sm">
                            <select wire:model="taxType"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-l-xl rounded-r-none py-2.5 outline-none px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm transition-all cursor-pointer relative z-10">
                                <option value="PPh22">PPh 22</option>
                                <option value="PPh23">PPh 23</option>
                                <option value="Ppn">PPN</option>
                            </select>
                            <div
                                class="flex items-center justify-center px-4 rounded-r-xl bg-blue-50 dark:bg-blue-900/40 border border-l-0 border-gray-300 dark:border-gray-600 text-blue-700 dark:text-blue-300 font-medium text-sm min-w-[80px]">
                                <span x-text="$wire.taxPersentase"></span>%
                            </div>
                        </div>
                    </div>

                    {{-- Expense Date --}}
                    <div class="space-y-1.5 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Tanggal Pengeluaran <span class="text-red-500">*</span>
                        </label>
                        <input type="date" wire:model="expenseDate"
                            class="w-full border outline-none border-gray-300 dark:border-gray-600 rounded-xl py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm transition-all" />
                        @error('expenseDate')
                            <span class="text-red-500 text-xs block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Proof File with Preview - Full Width --}}
                <div class="space-y-2" x-data="{
                    previewUrl: null,
                    isImage: false,
                    fileName: null,
                    showExisting: false,
                    existingUrl: null,
                    init() {
                        // Listen for edit mode initialization via window event
                        window.addEventListener('set-existing-proof', (event) => {
                            if (event.detail && event.detail.url) {
                                this.existingUrl = event.detail.url;
                                this.showExisting = true;
                                this.previewUrl = null;
                                this.fileName = null;
                            } else {
                                this.showExisting = false;
                                this.existingUrl = null;
                            }
                        });
                
                        // Listen for reset when opening in create mode
                        window.addEventListener('reset-proof-file', () => {
                            this.previewUrl = null;
                            this.isImage = false;
                            this.fileName = null;
                            this.showExisting = false;
                            this.existingUrl = null;
                            if (this.$refs.fileInput) {
                                this.$refs.fileInput.value = '';
                            }
                        });
                    },
                    handleFileSelect(event) {
                        const file = event.target.files[0];
                        if (file) {
                            this.fileName = file.name;
                            this.showExisting = false;
                            const imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                            if (imageTypes.includes(file.type)) {
                                this.isImage = true;
                                this.previewUrl = URL.createObjectURL(file);
                            } else {
                                this.isImage = false;
                                this.previewUrl = null;
                            }
                        }
                    },
                    clearFile() {
                        this.previewUrl = null;
                        this.isImage = false;
                        this.fileName = null;
                        this.showExisting = false;
                        $wire.proofFile = null;
                        this.$refs.fileInput.value = '';
                    }
                }">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Bukti Transaksi
                    </label>

                    {{-- Upload Area Container --}}
                    <div class="relative">
                        {{-- File Input (Hidden) --}}
                        <input type="file" wire:model="proofFile" x-ref="fileInput"
                            @change="handleFileSelect($event)" accept=".jpg,.jpeg,.png,.pdf" class="sr-only"
                            id="proof-file-input" />

                        {{-- Upload Box - Only show when no file selected, not loading, and NOT in edit mode --}}
                        <label for="proof-file-input" x-show="!$wire.isEditMode && !previewUrl && !fileName"
                            wire:loading.class="hidden" wire:target="proofFile"
                            class="flex flex-col items-center justify-center w-full py-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 hover:border-blue-400 dark:hover:border-blue-500 transition-all duration-200 group">
                            <svg class="w-10 h-10 mb-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p
                                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-500 transition-colors">
                                <span class="font-semibold">Klik untuk upload bukti</span>
                            </p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">JPG, PNG atau PDF (Max. 5MB)</p>
                        </label>

                        {{-- Loading Indicator - Centered properly --}}
                        <div wire:loading wire:target="proofFile"
                            class="w-full py-8 border-2 border-blue-300 dark:border-blue-600 rounded-xl bg-blue-50 dark:bg-blue-900/30">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="animate-spin h-10 w-10 text-blue-500 mb-3" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">Mengupload file...</p>
                                <p class="text-xs text-blue-500 dark:text-blue-500 mt-1">Mohon tunggu sebentar</p>
                            </div>
                        </div>

                        {{-- Unified File Preview Component --}}
                        <div x-show="(previewUrl && isImage) || ($wire.isEditMode && showExisting && existingUrl)"
                            wire:loading.remove wire:target="proofFile" x-transition class="relative">
                            <div class="flex items-center gap-3 w-full p-3 rounded-xl border"
                                :class="(previewUrl && isImage) ?
                                'border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700' :
                                'border-amber-200 dark:border-amber-600 bg-amber-50 dark:bg-amber-900/20'">
                                {{-- Thumbnail --}}
                                <div class="relative flex-shrink-0">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden border bg-gray-100 dark:bg-gray-800"
                                        :class="(previewUrl && isImage) ?
                                        'border-gray-200 dark:border-gray-600' :
                                        'border-amber-200 dark:border-amber-600'">
                                        <img :src="(previewUrl && isImage) ? previewUrl: existingUrl"
                                            class="w-full h-full object-cover" alt="Preview">
                                    </div>
                                </div>
                                {{-- File Info --}}
                                <div class="flex-1 min-w-0">
                                    {{-- New file info --}}
                                    <template x-if="previewUrl && isImage">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate"
                                                x-text="fileName"></p>
                                            <p
                                                class="text-xs text-green-600 dark:text-green-400 flex items-center gap-1 mt-0.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Siap diupload
                                            </p>
                                        </div>
                                    </template>
                                    {{-- Existing file info --}}
                                    <template
                                        x-if="!(previewUrl && isImage) && $wire.isEditMode && showExisting && existingUrl">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Bukti
                                                Transaksi Saat Ini</p>
                                            <p
                                                class="text-xs text-amber-600 dark:text-amber-400 flex items-center gap-1 mt-0.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Klik untuk mengganti
                                            </p>
                                        </div>
                                    </template>
                                </div>
                                {{-- Action Button --}}
                                <template x-if="previewUrl && isImage">
                                    <button type="button" @click="clearFile()"
                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors flex-shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </template>
                                <template
                                    x-if="!(previewUrl && isImage) && $wire.isEditMode && showExisting && existingUrl">
                                    <label for="proof-file-input"
                                        class="px-3 py-1.5 text-xs font-medium text-amber-700 dark:text-amber-300 bg-amber-100 dark:bg-amber-800/50 hover:bg-amber-200 dark:hover:bg-amber-800 rounded-lg transition-colors cursor-pointer flex-shrink-0">
                                        Ganti
                                    </label>
                                </template>
                            </div>
                        </div>
                    </div>

                    @error('proofFile')
                        <span class="text-red-500 text-xs block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Summary Card --}}
                <div
                    class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Rincian Perhitungan
                    </h4>
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
                            class="flex justify-between items-center pt-3 mt-1 border-t border-gray-200 dark:border-gray-600">
                            <span class="font-bold text-gray-800 dark:text-white">Jumlah Bersih (Net)</span>
                            <span class="font-bold text-green-600 dark:text-green-400 text-lg">Rp <span
                                    x-text="netAmount.toLocaleString('id-ID')"></span></span>
                        </div>
                    </div>
                </div>

                {{-- Description (Full Width) --}}
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea wire:model="description" rows="2"
                        class="w-full border outline-none border-gray-300 dark:border-gray-600 rounded-xl py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 resize-none"
                        placeholder="Keterangan pengeluaran (opsional)..."></textarea>
                </div>
            </div>

            {{-- Footer --}}
            <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex justify-end gap-3">
                <button type="button" @click="$wire.showAddModal = false; $wire.resetForm()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Batal
                </button>

                {{-- Add Mode Button --}}
                <button x-show="!$wire.isEditMode" type="button" wire:click="saveExpense"
                    wire:loading.attr="disabled"
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

                {{-- Edit Mode Button --}}
                <button x-show="$wire.isEditMode" type="button" wire:click="updateExpense"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                    <svg wire:loading wire:target="updateExpense" class="animate-spin h-4 w-4" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span wire:loading.remove wire:target="updateExpense">Perbarui Transaksi</span>
                    <span wire:loading wire:target="updateExpense">Memperbarui...</span>
                </button>
            </div>
        </div>
    </div>
</div>
