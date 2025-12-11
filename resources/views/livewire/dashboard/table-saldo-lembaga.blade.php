<div x-data="modalData()" class="max-w-7xl mx-auto mb-10">
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md dark:shadow-none border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Ringkasan Saldo Lembaga
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Rekapitulasi dana masuk, terpakai, dan sisa saldo
                </p>
            </div>
            
            <!-- Search & Per Page -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Search -->
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="Cari lembaga..."
                        class="w-full sm:w-64 px-4 py-2 pl-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg 
                               bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 outline-none
                               focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               placeholder-gray-400 dark:placeholder-gray-500">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>
                
                <!-- Per Page -->
                <select 
                    wire:model.live="perPage"
                    class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                           focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="5">5 per halaman</option>
                    <option value="10">10 per halaman</option>
                    <option value="25">25 per halaman</option>
                    <option value="50">50 per halaman</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">Lembaga</th>
                        <th class="px-6 py-4 text-left font-semibold">Total Dana</th>
                        <th class="px-6 py-4 text-left font-semibold">Terpakai</th>
                        <th class="px-6 py-4 text-left font-semibold">Sisa Saldo</th>
                        <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($dataLembaga as $lembaga)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <!-- Lembaga -->
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                {{ $lembaga['organization_name'] }}
                            </td>
                            <!-- Total Dana -->
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                Rp {{ number_format($lembaga['total_funds_used'] + $lembaga['current_balance'], 0, ',', '.') }}
                            </td>
                            <!-- Terpakai -->
                            <td class="px-6 py-4 text-red-600 dark:text-red-400 font-medium">
                                Rp {{ number_format($lembaga['total_funds_used'], 0, ',', '.') }}
                            </td>
                            <!-- Sisa Saldo -->
                            <td class="px-6 py-4 text-green-600 dark:text-green-400 font-semibold">
                                Rp {{ number_format($lembaga['current_balance'], 0, ',', '.') }}
                            </td>
                            <!-- Aksi -->
                            <td class="px-6 py-4 text-center">
                                <button
                                    @click="openModal(@js($lembaga['activities']), @js($lembaga['organization_name']))"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold rounded-lg
                                           bg-blue-600 hover:bg-blue-700 text-white
                                           transition shadow-sm">
                                    <i class="fas fa-eye text-xs"></i>
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <i class="fas fa-inbox text-4xl text-gray-400 dark:text-gray-600"></i>
                                    <p class="text-gray-500 dark:text-gray-400">
                                        @if($search)
                                            Tidak ada data lembaga dengan kata kunci "{{ $search }}"
                                        @else
                                            Belum ada data lembaga
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        @if($dataLembaga->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <!-- Info -->
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Menampilkan 
                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $dataLembaga->firstItem() ?? 0 }}</span>
                    sampai 
                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $dataLembaga->lastItem() ?? 0 }}</span>
                    dari 
                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $dataLembaga->total() }}</span>
                    data
                </div>

                <!-- Pagination Buttons -->
                <div class="flex items-center gap-2">
                    {{-- First Page --}}
                    @if ($dataLembaga->onFirstPage())
                        <button disabled class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                               bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                            <i class="fas fa-angle-double-left"></i>
                        </button>
                    @else
                        <button wire:click="gotoPage(1)" 
                                class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                                       hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <i class="fas fa-angle-double-left"></i>
                        </button>
                    @endif

                    {{-- Previous Page --}}
                    @if ($dataLembaga->onFirstPage())
                        <button disabled class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                               bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                            <i class="fas fa-angle-left"></i>
                        </button>
                    @else
                        <button wire:click="previousPage" 
                                class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                                       hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <i class="fas fa-angle-left"></i>
                        </button>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($dataLembaga->getUrlRange(max(1, $dataLembaga->currentPage() - 2), min($dataLembaga->lastPage(), $dataLembaga->currentPage() + 2)) as $page => $url)
                        @if ($page == $dataLembaga->currentPage())
                            <button class="px-4 py-2 text-sm rounded-lg font-semibold
                                          bg-blue-600 text-white shadow-sm">
                                {{ $page }}
                            </button>
                        @else
                            <button wire:click="gotoPage({{ $page }})" 
                                    class="px-4 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                           bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                                           hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach

                    {{-- Next Page --}}
                    @if ($dataLembaga->hasMorePages())
                        <button wire:click="nextPage" 
                                class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                                       hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <i class="fas fa-angle-right"></i>
                        </button>
                    @else
                        <button disabled class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                               bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                            <i class="fas fa-angle-right"></i>
                        </button>
                    @endif

                    {{-- Last Page --}}
                    @if ($dataLembaga->hasMorePages())
                        <button wire:click="gotoPage({{ $dataLembaga->lastPage() }})" 
                                class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                       bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                                       hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <i class="fas fa-angle-double-right"></i>
                        </button>
                    @else
                        <button disabled class="px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 
                                               bg-gray-100 dark:bg-gray-800 text-gray-400 dark:text-gray-600 cursor-not-allowed">
                            <i class="fas fa-angle-double-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @include('livewire.dashboard.component.modal-ringkasan-saldo')
    </div>
</div>

