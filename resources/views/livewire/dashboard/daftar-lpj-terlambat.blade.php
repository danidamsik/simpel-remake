<div
    class="bg-white dark:bg-gray-900 text-slate-900 dark:text-slate-100 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg font-semibold mb-4">Daftar LPJ Terlambat</h3>

    @if ($lpjTerlambat->isEmpty())
        <p class="text-slate-500 dark:text-slate-400">Tidak ada LPJ terlambat saat ini.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-slate-700 text-sm text-black dark:text-white">
                        <th class="px-3 py-2 text-left">Kegiatan</th>
                        <th class="px-3 py-2 text-left">Organisasi</th>
                        <th class="px-3 py-2 text-left">Lembaga</th>
                        <th class="px-3 py-2 text-left">Tanggal Selesai</th>
                        <th class="px-3 py-2 text-left">Tenggat LPJ</th>
                        <th class="px-3 py-2 text-left">Terlambat</th>
                        <th class="px-3 py-2 text-left">Status</th>
                        <th class="px-3 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @foreach ($lpjTerlambat as $item)
                        @php
                            $end = \Carbon\Carbon::parse($item->end_date);
                            $deadline = isset($item->deadline)
                                ? \Carbon\Carbon::parse($item->deadline)
                                : $end->copy()->addDays(7);

                            $days = $end->diffInDays(now());
                            $daysLate = now()->diffInDays($deadline, false);

                            $status = null;
                            $statusColor = '';

                            if ($days >= 14) {
                                $status = 'Perlu Tindakan';
                                $statusColor = 'text-red-600 dark:text-red-400';
                            } elseif ($days >= 7) {
                                $status = 'Peringatan';
                                $statusColor = 'text-yellow-600 dark:text-yellow-400';
                            }
                        @endphp

                        <tr
                            class="border-b border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                            <td class="px-3 py-2">{{ $item->activity_name }}</td>
                            <td class="px-3 py-2">{{ $item->name }}</td>
                            <td class="px-3 py-2">{{ $item->lembaga }}</td>

                            <td class="px-3 py-2">
                                {{ $end->format('d M Y') }}
                                <span class="text-xs text-slate-500 dark:text-slate-400">
                                    ({{ $days }} hari lalu)
                                </span>
                            </td>

                            <td class="px-3 py-2">{{ $deadline->format('d M Y') }}</td>

                            <td class="px-3 py-2">
                                @if ($daysLate < 0)
                                    <span class="text-red-600 dark:text-red-400 font-medium">
                                        {{ abs($daysLate) }} hari
                                    </span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>

                            {{-- ✅ STATUS TANPA BACKGROUND --}}
                            <td class="px-3 py-2 font-medium {{ $statusColor }}">
                                {{ $status ?? '-' }}
                            </td>

                            <td class="px-3 py-2">
                                <div class="relative" x-data="{ open: false }">
                                    <!-- Ellipsis Button -->
                                    <button @click="open = !open" @click.outside="open = false"
                                        class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" x-transition
                                        class="absolute right-0 z-50 mt-1 w-40 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1">

                                        <!-- Kirim Pesan -->
                                        <a href="https://wa.me/?text={{ urlencode(
                                            'Halo ' .
                                                $item->name .
                                                ', kami mengingatkan bahwa LPJ untuk kegiatan "' .
                                                $item->activity_name .
                                                '" (' .
                                                $item->lembaga .
                                                ') belum diserahkan. Tenggat: ' .
                                                $deadline->format('d M Y'),
                                        ) }}"
                                            target="_blank"
                                            class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            Kirim Pesan
                                        </a>

                                        <!-- Lihat Logs -->
                                        <button wire:click="showLogs({{ $item->activity_id }})"
                                            class="w-full flex items-center gap-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Lihat Logs
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
