<div x-data="kegiatanData()" class="max-w-7xl mx-auto mb-8">
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

            <span
                class="px-3 py-1 rounded-full text-xs font-semibold
                       bg-green-100 dark:bg-green-900
                       text-green-700 dark:text-green-300">
                <span x-text="activities.length"></span> Aktif
            </span>
        </div>

        <!-- Content -->
        <div class="p-5">

            <!-- Cards -->
            <template x-if="activities.length > 0">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    <template x-for="(kegiatan, index) in activities" :key="index">
                        <div
                            class="border border-gray-200 dark:border-gray-700
                                   rounded-lg p-4 space-y-3
                                   bg-white dark:bg-gray-800">

                            <div class="flex justify-between text-xs
                                        text-gray-600 dark:text-gray-400">
                                <span>Berlangsung</span>
                                <span x-text="hitungHariTersisa(kegiatan.tanggal_selesai) + ' hari'"></span>
                            </div>

                            <h3 class="font-semibold text-gray-900 dark:text-white text-sm"
                                x-text="kegiatan.nama_kegiatan"></h3>

                            <div class="text-xs space-y-1
                                        text-gray-700 dark:text-gray-300">

                                <div>
                                    <b>Lembaga:</b>
                                    <span x-text="kegiatan.nama_organisasi"></span>
                                </div>

                                <div>
                                    <b>Periode:</b>
                                    <span
                                        x-text="formatPeriode(kegiatan.tanggal_mulai, kegiatan.tanggal_selesai)"></span>
                                </div>

                                <div>
                                    <b>Penanggung Jawab:</b>
                                    <span x-text="kegiatan.penanggung_jawab"></span>
                                </div>

                            </div>

                        </div>
                    </template>

                </div>
            </template>

            <!-- Empty State -->
            <template x-if="activities.length === 0">
                <div class="text-center py-10 text-gray-600 dark:text-gray-400 text-sm">
                    Tidak ada kegiatan aktif
                </div>
            </template>

        </div>
    </div>
</div>

@script
<script>
    Alpine.data('kegiatanData', () => ({
        activities: @json($activities),

        formatPeriode(startDate, endDate) {
            if (!startDate || !endDate) return '-';

            const start = new Date(startDate);
            const end = new Date(endDate);

            const startDay = start.getDate();
            const endDay = end.getDate();

            const startMonth = start.toLocaleDateString('id-ID', { month: 'short' });
            const endMonth = end.toLocaleDateString('id-ID', { month: 'short' });

            const year = end.getFullYear();

            if (startMonth === endMonth) {
                return `${startDay}-${endDay} ${startMonth} ${year}`;
            }

            return `${startDay} ${startMonth} - ${endDay} ${endMonth} ${year}`;
        },

        hitungHariTersisa(endDate) {
            if (!endDate) return 0;
            
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset waktu untuk perhitungan akurat
            
            const end = new Date(endDate);
            end.setHours(0, 0, 0, 0);

            const diff = Math.ceil((end - today) / (1000 * 60 * 60 * 24));
            return diff >= 0 ? diff : 0;
        }
    }));
</script>
@endscript