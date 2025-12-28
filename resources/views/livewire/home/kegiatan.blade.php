<div
    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
    <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Kegiatan</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr
                    class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider">
                    <th class="p-4 font-semibold">Nama Kegiatan</th>
                    <th class="p-4 font-semibold">Tanggal</th>
                    <th class="p-4 font-semibold">Lokasi</th>
                    <th class="p-4 font-semibold text-right">Dana Terpakai</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                    <th class="p-4 font-semibold text-center">LPJ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @foreach ($kegiatan as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors group">
                        <td class="p-4">
                            <div
                                class="font-semibold text-slate-800 dark:text-slate-200 group-hover:text-indigo-600 transition-colors">
                                {{ $item['nama'] }}</div>
                        </td>
                        <td class="p-4 text-sm text-slate-600 dark:text-slate-300">
                            {{ \Carbon\Carbon::parse($item['mulai'])->format('d M') }} -
                            {{ \Carbon\Carbon::parse($item['selesai'])->format('d M Y') }}
                        </td>
                        <td class="p-4 text-sm text-slate-600 dark:text-slate-300">
                            <i class="fas fa-map-marker-alt text-slate-400 mr-1"></i> {{ $item['lokasi'] }}
                        </td>
                        <td class="p-4 text-right font-medium text-slate-700 dark:text-slate-300">
                            Rp {{ number_format($item['dana'], 0, ',', '.') }}
                        </td>
                        <td class="p-4 text-center">
                            @php
                                $statusClass = match ($item['status']) {
                                    'Selesai' => 'text-emerald-600',
                                    'Sedang berjalan' => 'text-blue-600',
                                    'Belum dimulai' => 'text-slate-500',
                                    default => 'text-slate-500',
                                };
                            @endphp
                            <span class="text-xs font-semibold {{ $statusClass }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @php
                                $lpjClass = match ($item['status_lpj']) {
                                    'Disetujui' => 'text-emerald-600',
                                    'Belum Disetor' => 'text-amber-600',
                                    default => 'text-slate-400',
                                };
                            @endphp
                            <span class="text-xs font-semibold {{ $lpjClass }}">
                                {{ $item['status_lpj'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
