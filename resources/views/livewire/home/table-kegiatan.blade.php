<div class="mb-8 sm:mb-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-700 dark:text-gray-200">Kegiatan Terbaru</h2>
    </div>

    <!-- Responsive Table Container -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <!-- Desktop Headers -->
                <thead class="hidden sm:table-header-group bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th
                            class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 whitespace-nowrap">
                            Nama Kegiatan
                        </th>
                        <th
                            class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 whitespace-nowrap">
                            Tanggal
                        </th>
                        <th
                            class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 whitespace-nowrap">
                            Status
                        </th>
                        <th
                            class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 whitespace-nowrap">
                            Lokasi
                        </th>
                        <th
                            class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 whitespace-nowrap">
                            Dana
                        </th>
                        <th
                            class="py-3 px-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200 whitespace-nowrap">
                            Status LPJ
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <!-- Mobile View: Combined Cells -->
                        <td class="sm:hidden p-4">
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-800 dark:text-white text-sm">Workshop
                                            Digital Marketing</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pelatihan
                                            pemasaran digital untuk UMKM</p>
                                    </div>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 ml-2">
                                        <i class="fas fa-spinner fa-spin mr-1"></i>
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-3 text-xs">
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Tanggal</p>
                                        <p class="font-medium dark:text-white mt-1">15-17 Nov 2023</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Lokasi</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-map-marker-alt text-red-400 mr-1 text-xs"></i>
                                            <span class="font-medium dark:text-white truncate">Gedung Serba
                                                Guna</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Dana</p>
                                        <p class="font-medium dark:text-white mt-1">Rp 8.500.000</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Status LPJ</p>
                                        <span
                                            class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200 mt-1">
                                            <i class="fas fa-clock mr-1"></i> Menunggu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Desktop View: Separate Cells -->
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="max-w-[200px]">
                                <p class="font-medium text-gray-800 dark:text-white text-sm truncate">Workshop
                                    Digital Marketing</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">Pelatihan
                                    pemasaran digital untuk UMKM</p>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="text-sm dark:text-gray-300 whitespace-nowrap">
                                <p>15 Nov 2023</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">s/d 17 Nov 2023</p>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 whitespace-nowrap">
                                <i class="fas fa-spinner fa-spin mr-1"></i> Berlangsung
                            </span>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="flex items-center dark:text-gray-300">
                                <i class="fas fa-map-marker-alt text-red-400 mr-2 text-sm"></i>
                                <span class="text-sm truncate max-w-[120px]">Gedung Serba Guna</span>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <p class="font-medium dark:text-white text-sm">Rp 8.500.000</p>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200 whitespace-nowrap">
                                <i class="fas fa-clock mr-1"></i> Menunggu
                            </span>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <!-- Mobile View: Combined Cells -->
                        <td class="sm:hidden p-4">
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-800 dark:text-white text-sm">Seminar
                                            Kewirausahaan</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Membangun
                                            mindset entrepreneur</p>
                                    </div>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 ml-2">
                                        <i class="fas fa-check-circle mr-1"></i>
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-3 text-xs">
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Tanggal</p>
                                        <p class="font-medium dark:text-white mt-1">10 Nov 2023</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Lokasi</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-map-marker-alt text-red-400 mr-1 text-xs"></i>
                                            <span class="font-medium dark:text-white truncate">Auditorium
                                                Utama</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Dana</p>
                                        <p class="font-medium dark:text-white mt-1">Rp 12.000.000</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Status LPJ</p>
                                        <span
                                            class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 mt-1">
                                            <i class="fas fa-check-circle mr-1"></i> Tersetor
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Desktop View: Separate Cells -->
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="max-w-[200px]">
                                <p class="font-medium text-gray-800 dark:text-white text-sm truncate">Seminar
                                    Kewirausahaan</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">Membangun
                                    mindset entrepreneur</p>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="text-sm dark:text-gray-300 whitespace-nowrap">
                                <p>10 Nov 2023</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">s/d 10 Nov 2023</p>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 whitespace-nowrap">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="flex items-center dark:text-gray-300">
                                <i class="fas fa-map-marker-alt text-red-400 mr-2 text-sm"></i>
                                <span class="text-sm truncate max-w-[120px]">Auditorium Utama</span>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <p class="font-medium dark:text-white text-sm">Rp 12.000.000</p>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 whitespace-nowrap">
                                <i class="fas fa-check-circle mr-1"></i> Tersetor
                            </span>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <!-- Mobile View: Combined Cells -->
                        <td class="sm:hidden p-4">
                            <div class="space-y-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-800 dark:text-white text-sm">Pelatihan
                                            Teknologi</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Pengenalan
                                            teknologi terkini</p>
                                    </div>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 ml-2">
                                        <i class="fas fa-check-circle mr-1"></i>
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-3 text-xs">
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Tanggal</p>
                                        <p class="font-medium dark:text-white mt-1">5-7 Nov 2023</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Lokasi</p>
                                        <div class="flex items-center mt-1">
                                            <i class="fas fa-map-marker-alt text-red-400 mr-1 text-xs"></i>
                                            <span class="font-medium dark:text-white truncate">Lab
                                                Komputer</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Dana</p>
                                        <p class="font-medium dark:text-white mt-1">Rp 6.750.000</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Status LPJ</p>
                                        <span
                                            class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200 mt-1">
                                            <i class="fas fa-clock mr-1"></i> Menunggu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Desktop View: Separate Cells -->
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="max-w-[200px]">
                                <p class="font-medium text-gray-800 dark:text-white text-sm truncate">Pelatihan
                                    Teknologi</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">Pengenalan
                                    teknologi terkini</p>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="text-sm dark:text-gray-300 whitespace-nowrap">
                                <p>5 Nov 2023</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">s/d 7 Nov 2023</p>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200 whitespace-nowrap">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <div class="flex items-center dark:text-gray-300">
                                <i class="fas fa-map-marker-alt text-red-400 mr-2 text-sm"></i>
                                <span class="text-sm truncate max-w-[120px]">Lab Komputer</span>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <p class="font-medium dark:text-white text-sm">Rp 6.750.000</p>
                        </td>
                        <td class="hidden sm:table-cell py-4 px-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200 whitespace-nowrap">
                                <i class="fas fa-clock mr-1"></i> Menunggu
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>