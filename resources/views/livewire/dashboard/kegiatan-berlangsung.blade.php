<div class="max-w-7xl mx-auto mb-8">
    <div class="bg-white dark:bg-gray-900 rounded-lg shadow border border-gray-200 dark:border-gray-700">

        <!-- Header -->
        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Kegiatan Berlangsung
                </h2>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    Kegiatan yang sedang aktif
                </p>
            </div>

            <div class="flex items-center gap-3">
                <select wire:model.live="limit"
                    class="text-xs border border-gray-300 dark:border-gray-600 rounded-lg px-2 py-1
                           bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300
                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                </select>

                <span
                    class="px-3 py-1 rounded-full text-xs font-semibold
                           bg-green-100 dark:bg-green-900
                           text-green-700 dark:text-green-300">
                    {{ count($activities) }} Aktif
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-5">

            @if (count($activities) > 0)
                <!-- Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($activities as $kegiatan)
                        <div
                            class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 space-y-3 bg-white dark:bg-gray-800">

                            <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
                                <span>Berlangsung</span>
                                <span>{{ $this->hitungHariTersisa($kegiatan['tanggal_selesai']) }} hari</span>
                            </div>

                            <h3 class="font-semibold text-gray-900 dark:text-white text-sm">
                                {{ $kegiatan['nama_kegiatan'] }}
                            </h3>

                            <div class="text-xs space-y-1 text-gray-700 dark:text-gray-300">
                                <div>
                                    <b>Organisasi:</b>
                                    <span>{{ $kegiatan['nama_organisasi'] }}</span>
                                </div>

                                <div>
                                    <b>Periode:</b>
                                    <span>{{ $this->formatPeriode($kegiatan['tanggal_mulai'], $kegiatan['tanggal_selesai']) }}</span>
                                </div>

                                <div>
                                    <b>Penanggung Jawab:</b>
                                    <span>{{ $kegiatan['penanggung_jawab'] }}</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-10 text-gray-600 dark:text-gray-400 text-sm">
                    Tidak ada kegiatan aktif
                </div>
            @endif

        </div>
    </div>
</div>
