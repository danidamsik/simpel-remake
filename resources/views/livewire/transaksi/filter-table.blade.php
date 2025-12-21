<div x-data="transactionTable" @close-add-modal.window="$wire.showAddModal = false">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 border border-gray-200 dark:border-gray-700">
        {{-- Flash Messages --}}
        @if (session()->has('success'))
            <div
                class="mb-4 p-4 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Daftar Transaksi</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Kelola pengeluaran dan transaksi lembaga</p>
            </div>
            <!-- Button Tambah Transaksi -->
            <button @click="openAddModal()"
                class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-medium py-2.5 px-5 rounded-lg flex items-center justify-center transition duration-200 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Transaksi
            </button>
        </div>

        <!-- Filters Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Filter Lembaga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter Fakultas</label>
                <div class="relative">
                    <select wire:model.live="selectedLembaga"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 pl-4 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Semua Fakultas</option>
                        @foreach ($lembagas as $lembaga)
                            <option value="{{ $lembaga }}">{{ $lembaga }}</option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Periode -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter Periode</label>
                <div class="relative">
                    <select wire:model.live="selectedPeriod"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 pl-4 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Semua Periode</option>
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}">{{ $period->name }}</option>
                        @endforeach
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cari Nama organisasi atau
                Kegiatan</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400"
                    placeholder="Cari berdasarkan nama organisasi atau kegiatan...">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Nama Organisasi</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Nama Kegiatan</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Jumlah</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tanggal Pengeluaran</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($expenses as $expense)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 flex-shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $expense->organization->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $expense->organization->lembaga }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $expense->activity->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Rp
                                    {{ number_format($expense->amount, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button @click="openDetail({{ $expense->id }})"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 flex items-center group">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-1 group-hover:scale-110 transition-transform" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-12 w-12 text-gray-400 dark:text-gray-500 mb-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada data transaksi
                                    </p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Silakan tambah transaksi
                                        baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-global.pagination :paginator="$expenses" />
    </div>
    @include('livewire.transaksi.component.modal-detail')
    @include('livewire.transaksi.component.modal-image')
    @include('livewire.transaksi.component.modal-add')

</div>

@script
    <script>
        Alpine.data('transactionTable', () => ({
            taxRates: {
                'PPh22': 1.5,
                'PPh23': 2,
                'Ppn': 12
            },

            // Add Modal State & Logic
            taxAmount: 0,
            netAmount: 0,
            displayAmount: '',

            openAddModal() {
                // Reset properties
                $wire.selectedActivity = null;
                $wire.selectedWallet = null;
                $wire.amount = '';
                $wire.description = '';
                $wire.expenseDate = new Date().toISOString().split('T')[0];
                $wire.taxType = 'PPh22';
                $wire.taxPersentase = this.taxRates['PPh22'];
                $wire.proofFile = null;

                // Reset calculations and display
                this.taxAmount = 0;
                this.netAmount = 0;
                this.displayAmount = '';

                // Show modal
                $wire.showAddModal = true;

                // Watch for changes
                this.$watch('$wire.taxType', (value) => {
                    if (this.taxRates[value] !== undefined) {
                        $wire.taxPersentase = this.taxRates[value];
                        this.calculateValues();
                    }
                });

                this.$watch('displayAmount', (value) => {
                    // Remove non-digit chars
                    let rawValue = value.replace(/\D/g, '');

                    // Update wire model directly
                    $wire.amount = rawValue;

                    // Format for display
                    if (rawValue) {
                        this.displayAmount = this.formatNumber(rawValue);
                    } else {
                        this.displayAmount = '';
                    }
                });

                this.$watch('$wire.amount', (value) => {
                    if (value && value !== this.displayAmount.replace(/\./g, '')) {
                        this.displayAmount = this.formatNumber(value);
                    }
                    this.calculateValues();
                });

                this.$watch('$wire.taxPersentase', () => this.calculateValues());
            },

            formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },

            calculateValues() {
                const amount = parseFloat($wire.amount) || 0;
                const percentage = parseFloat($wire.taxPersentase) || 0;

                this.taxAmount = amount * (percentage / 100);
                this.netAmount = amount - this.taxAmount;
            },

            // Detail Modal State & Logic
            showModal: false,
            expenseDetail: null,
            loading: false,
            showImageModal: false,
            imageUrl: null,

            async openDetail(expenseId) {
                this.loading = true;
                this.showModal = true;

                try {
                    const data = await $wire.getExpenseDetail(expenseId);

                    if (data.error) {
                        alert(data.message);
                        this.showModal = false;
                    } else {
                        this.expenseDetail = data;
                    }
                } catch (error) {
                    console.error('Error fetching expense detail:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                    this.showModal = false;
                } finally {
                    this.loading = false;
                }
            },

            closeModal() {
                this.showModal = false;
                this.expenseDetail = null;
                this.loading = false;
            },

            openImageModal(url) {
                this.imageUrl = url;
                this.showImageModal = true;
            },

            closeImageModal() {
                this.showImageModal = false;
                this.imageUrl = null;
            },

            init() {
                if (typeof this.initModal === 'function') this.initModal();
            }
        }));
    </script>
@endscript
