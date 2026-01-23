<div x-data="{
    photoPreview: null,
    init() {
        this.$watch('$wire.showModal', value => {
            if (value) {
                // Reset preview saat modal dibuka
                this.photoPreview = null;
                if (this.$refs.logo) this.$refs.logo.value = '';

                // Set preview dari existing logo jika edit mode
                if ($wire.editMode && $wire.existingLogoPath) {
                    this.photoPreview = '/storage/' + $wire.existingLogoPath;
                }
            }
        })
    },
    reset() {
        // Reset Livewire properties client-side
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

        // Reset local state
        this.photoPreview = null;
        if (this.$refs.logo) this.$refs.logo.value = '';

        // Reset form and close modal
        $wire.resetForm();
        $wire.showModal = false;
    }
}" x-show="$wire.showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <!-- Background overlay -->
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="$wire.showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-80"
            @click="$wire.showModal = false">
        </div>

        <!-- Center modal -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal panel -->
        <div x-show="$wire.showModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-3xl p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-gray-800 shadow-xl rounded-2xl">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100" id="modal-title">
                        <span x-text="$wire.editMode ? 'Edit Organisasi' : 'Tambah Organisasi Baru'"></span>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        <span
                            x-text="$wire.editMode ? 'Perbarui informasi organisasi di bawah' : 'Lengkapi form di bawah untuk menambahkan organisasi baru'"></span>
                    </p>
                </div>
                <button type="button" @click="$wire.showModal = false"
                    class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <form wire:submit.prevent="{{ '$wire.editMode ? \'update\' : \'store\'' }}"
                x-on:submit.prevent="$wire.editMode ? $wire.update() : $wire.store()" class="space-y-6">

                <!-- Section: Informasi Lembaga -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Informasi Organisasi
                    </h4>

                    <!-- Logo Upload -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Logo Organisasi
                        </label>
                        <div class="flex items-center gap-4">
                            <!-- Preview -->
                            <div class="flex-shrink-0">
                                <img x-show="photoPreview" :src="photoPreview" alt="Preview"
                                    class="h-16 w-16 rounded-lg object-cover border-2 border-gray-200 dark:border-gray-600"
                                    style="display: none;">
                                <div x-show="!photoPreview"
                                    class="h-16 w-16 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>
                            <!-- Upload Button -->
                            <div class="flex-1">
                                <label @click.prevent="$refs.logo.click()"
                                    class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Pilih Logo
                                </label>
                                <input type="file" wire:model="logo" x-ref="logo" accept="image/*" class="hidden"
                                    @change="
                                        const reader = new FileReader();
                                        reader.onload = (e) => { photoPreview = e.target.result; };
                                        reader.readAsDataURL($refs.logo.files[0]);
                                    ">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG hingga 2MB</p>
                            </div>
                        </div>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama Lembaga -->
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Organisasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" wire:model="name"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('name') border-red-500 @enderror"
                                placeholder="Nama lembaga">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fakultas/Lembaga -->
                        <div>
                            <label for="lembaga"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fakultas <span class="text-red-500">*</span>
                            </label>
                            <select id="lembaga" wire:model="lembaga"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('lembaga') border-red-500 @enderror">
                                <option value="">Pilih Fakultas</option>
                                @foreach ($lembagaOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('lembaga')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label for="number_phone"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                No. Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="number_phone" wire:model="number_phone"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('number_phone') border-red-500 @enderror"
                                placeholder="08xxxxxxxxxx">
                            @error('number_phone')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" wire:model="email"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('email') border-red-500 @enderror"
                                placeholder="email@lembaga.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Bendahara -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Bendahara
                    </h4>

                    <div>
                        <label for="selectedUserId"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pilih Bendahara <span class="text-red-500">*</span>
                        </label>
                        <select id="selectedUserId" wire:model="selectedUserId"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('selectedUserId') border-red-500 @enderror">
                            <option value="">Pilih Bendahara</option>
                            @forelse ($availableBendaharas as $bendahara)
                                <option wire:key="bendahara-{{ $bendahara->id }}" value="{{ $bendahara->id }}">
                                    {{ $bendahara->username }}
                                    ({{ $bendahara->email }})
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada bendahara tersedia</option>
                            @endforelse
                        </select>
                        @error('selectedUserId')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @if ($availableBendaharas->isEmpty())
                            <p class="mt-1 text-sm text-yellow-600 dark:text-yellow-400">
                                Semua bendahara sudah terdaftar. Tambahkan bendahara baru terlebih dahulu di tab User.
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Section: Informasi Rekening -->
                <div class="pb-4">
                    <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Informasi Rekening
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama Bank -->
                        <div>
                            <label for="bank_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Bank
                            </label>
                            <input type="text" id="bank_name" wire:model="bank_name"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('bank_name') border-red-500 @enderror"
                                placeholder="Contoh: BRI, BNI, Mandiri">
                            @error('bank_name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Akun -->
                        <div>
                            <label for="account_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Akun <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="account_name" wire:model="account_name"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('account_name') border-red-500 @enderror"
                                placeholder="Nama pemilik rekening">
                            @error('account_name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor Rekening -->
                        <div>
                            <label for="account_number"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nomor Rekening <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="account_number" wire:model="account_number"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('account_number') border-red-500 @enderror"
                                placeholder="Nomor rekening">
                            @error('account_number')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Saldo Awal -->
                        <div x-data="{
                            rawValue: $wire.balance || 0,
                            formattedValue: '',
                            formatNumber(num) {
                                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            },
                            parseNumber(str) {
                                return parseInt(str.replace(/\./g, '')) || 0;
                            },
                            init() {
                                this.formattedValue = this.formatNumber(this.rawValue);
                                this.$watch('$wire.balance', (value) => {
                                    this.rawValue = value || 0;
                                    this.formattedValue = this.formatNumber(this.rawValue);
                                });
                            },
                            updateValue(e) {
                                let cursorPos = e.target.selectionStart;
                                let oldLength = this.formattedValue.length;
                        
                                this.rawValue = this.parseNumber(e.target.value);
                                this.formattedValue = this.formatNumber(this.rawValue);
                                $wire.balance = this.rawValue;
                        
                                this.$nextTick(() => {
                                    let newLength = this.formattedValue.length;
                                    let newPos = cursorPos + (newLength - oldLength);
                                    e.target.setSelectionRange(newPos, newPos);
                                });
                            }
                        }">
                            <label for="balance"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Saldo Awal <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">Rp</span>
                                <input type="text" id="balance" x-model="formattedValue"
                                    @input="updateValue($event)"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all @error('balance') border-red-500 @enderror"
                                    placeholder="0">
                            </div>
                            @error('balance')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" @click="reset()"
                        class="px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="store, update, logo"
                        wire:loading.class="text-transparent transition-none"
                        class="relative px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <span x-text="$wire.editMode ? 'Perbarui' : 'Simpan'"></span>
                        <span wire:loading.flex wire:target="store, update"
                            class="absolute inset-0 items-center justify-center hidden text-white">
                            <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
