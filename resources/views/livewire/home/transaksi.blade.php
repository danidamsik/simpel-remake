<div x-data="{ showModal: false, activeProof: '' }"
    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
    <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Riwayat Transaksi</h3>
    </div>
    <div class="p-0">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead
                    class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="p-4 font-semibold">Tanggal</th>
                        <th class="p-4 font-semibold">Kegiatan</th>
                        <th class="p-4 font-semibold">Deskripsi</th>
                        <th class="p-4 font-semibold text-right">Jumlah</th>
                        <th class="p-4 font-semibold text-center">Bukti</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach ($transaksi as $tx)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="p-4 text-sm text-slate-600 dark:text-slate-300 whitespace-nowrap">
                                <div class="font-medium">{{ \Carbon\Carbon::parse($tx['tanggal'])->format('d M Y') }}
                                </div>
                                <div class="text-xs text-slate-400">
                                    {{ \Carbon\Carbon::parse($tx['tanggal'])->format('H:i') }} WIB</div>
                            </td>
                            <td class="p-4 text-sm font-medium text-slate-800 dark:text-slate-200">
                                {{ $tx['kegiatan'] }}
                            </td>
                            <td class="p-4 text-sm text-slate-600 dark:text-slate-300">
                                {{ $tx['deskripsi'] }}
                            </td>
                            <td class="p-4 text-right font-mono font-medium text-red-600 dark:text-red-400">
                                -Rp{{ number_format($tx['jumlah'], 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-center">
                                @if ($tx['bukti'])
                                    <button
                                        @click="activeProof = '{{ asset('storage/' . $tx['bukti']) }}'; showModal = true"
                                        class="text-slate-400 hover:text-indigo-600 transition-colors">
                                        <i class="fas fa-image"></i>
                                    </button>
                                @else
                                    <span class="text-slate-300"><i class="fas fa-minus"></i></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Proof -->
    <div x-show="showModal" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <!-- Close Button (Outside) -->
        <button @click="showModal = false"
            class="absolute top-6 right-6 text-white text-3xl hover:text-gray-300 z-50 transition-colors">
            <i class="fas fa-times"></i>
        </button>

        <div @click.away="showModal = false"
            class="relative max-w-4xl max-h-[90vh] overflow-hidden rounded-lg shadow-2xl">
            <img :src="activeProof" alt="Bukti Transaksi" class="w-full h-full object-contain max-h-[90vh]">
        </div>
    </div>
</div>
