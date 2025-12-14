<div x-show="activeTab === 'lembaga'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">

    <div class="mb-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">Data Lembaga</h2>
        <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola informasi lembaga dan bendahara</p>
    </div>

    <!-- Filter Section -->
    <div class="mb-4 flex flex-col sm:flex-row gap-3">
        <!-- Filter Lembaga Type -->
        <div class="w-full sm:w-48">
            <select wire:model.live="filterLembaga"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <option value="">Semua Lembaga</option>
                @foreach ($lembagaTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filter Period -->
        <div class="w-full sm:w-48">
            <select wire:model.live="filterPeriod"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
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
                        Lembaga</th>
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
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($organizations as $org)
                    @php
                        $colors = ['blue', 'green', 'purple', 'pink', 'indigo', 'teal', 'orange', 'red'];
                        $color = $colors[$loop->index % count($colors)];
                        $initial = strtoupper(substr($org->name, 0, 1));
                        $totalBalance = $org->wallets->sum('balance');
                    @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <td class="py-3 px-4">
                            @if ($org->logo_path)
                                <img src="{{ asset('storage/profile/' . $org->logo_path) }}" alt="{{ $org->name }}"
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
                                {{ $org->user->username ?? '-' }}
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
                                {{ 'Rp.' . number_format($totalBalance, 0, ',', '.') }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-500 dark:text-gray-400">
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
</div>
