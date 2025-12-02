 <!-- Header Section -->
 <div">
     <div class="mb-6">
         <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
             Laporan Dan Rekap
         </h1>
         <p class="text-gray-600 mt-1 dark:text-gray-300">
             Kelola dan unduh laporan kegiatan organisasi
         </p>
     </div>

     <!-- Main Card: Filter & Table Combined -->
     <div class="bg-white dark:border-gray-700 dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200">

         <!-- Filter Section Inside Card -->
         <div class="p-6 border-b border-gray-200">

             <!-- Filter Grid -->
             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                 <!-- Tanggal Mulai -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Tanggal Mulai</label>
                     <div class="relative">
                         <input type="date"
                             class="w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm">
                         <i
                             class="fas fa-calendar-alt absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                     </div>
                 </div>

                 <!-- Tanggal Selesai -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Tanggal Selesai</label>
                     <div class="relative">
                         <input type="date"
                             class="dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm">
                         <i
                             class="fas fa-calendar-check absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                     </div>
                 </div>

                 <!-- Status Kegiatan -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Status Kegiatan</label>
                     <div class="relative">
                         <select
                             class="w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none text-sm bg-white">
                             <option value="">Semua Status</option>
                             <option value="direncanakan">Direncanakan</option>
                             <option value="berlangsung">Berlangsung</option>
                             <option value="selesai">Selesai</option>
                             <option value="dibatalkan">Dibatalkan</option>
                         </select>
                         <i
                             class="fas fa-clipboard-list absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                         <i
                             class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                     </div>
                 </div>

                 <!-- Status LPJ -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Status LPJ</label>
                     <div class="relative">
                         <select
                             class="w-full dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none text-sm bg-white">
                             <option value="">Semua Status</option>
                             <option value="belum-diajukan">Belum Diajukan</option>
                             <option value="menunggu">Menunggu</option>
                             <option value="disetujui">Disetujui</option>
                             <option value="ditolak">Ditolak</option>
                         </select>
                         <i
                             class="fas fa-file-invoice absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                         <i
                             class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Export & Info Bar -->
         <div
             class="px-6 py-4 bg-gray-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 flex flex-wrap items-center justify-between gap-4">

             <!-- Total Info -->
             <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                 <i class="fas fa-database text-blue-600"></i>
                 <span>Total: <strong class="text-gray-900 dark:text-white">5 Kegiatan</strong></span>
             </div>

             <!-- Export Buttons -->
             <div class="flex gap-2">
                 <button
                     class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 dark:bg-emerald-700 dark:hover:bg-emerald-800 transition text-sm font-medium flex items-center gap-2 shadow-sm">
                     <i class="fas fa-file-excel"></i>
                     Excel
                 </button>

                 <button
                     class="px-4 py-2 bg-rose-600 text-white rounded-lg hover:bg-rose-700 dark:bg-rose-700 dark:hover:bg-rose-800 transition text-sm font-medium flex items-center gap-2 shadow-sm">
                     <i class="fas fa-file-pdf"></i>
                     PDF
                 </button>
             </div>
         </div>

         <!-- Table Section -->
         <div class="overflow-x-auto">
             <table class="w-full">

                 <!-- Table Head -->
                 <thead>
                     <tr class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                         <th
                             class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             No
                         </th>
                         <th
                             class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             Lembaga
                         </th>
                         <th
                             class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             Kegiatan
                         </th>
                         <th
                             class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             Tgl Mulai
                         </th>
                         <th
                             class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             Tgl Selesai
                         </th>
                         <th
                             class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             Dana Disetujui
                         </th>
                         <th
                             class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             Status Kegiatan
                         </th>
                         <th
                             class="px-6 py-4 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">
                             Status LPJ
                         </th>
                     </tr>
                 </thead>

                 <!-- Table Body -->
                 <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">

                     <!-- Row 1 -->
                     <tr class="hover:bg-blue-50/50 dark:hover:bg-gray-800 transition-colors">
                         <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 font-medium">1</td>
                         <td class="px-6 py-4">
                             <div class="flex items-center gap-3">
                                 <div
                                     class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center flex-shrink-0">
                                     <i class="fas fa-users text-blue-600"></i>
                                 </div>
                                 <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                     Himpunan Mahasiswa Teknik Informatika
                                 </span>
                             </div>
                         </td>
                         <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 max-w-xs">
                             Seminar Nasional AI & Machine Learning 2024
                         </td>
                         <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">15 Nov 2024
                         </td>
                         <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">16 Nov 2024
                         </td>
                         <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-gray-100 whitespace-nowrap">
                             Rp 15.000.000</td>
                         <td class="px-6 py-4 text-center">
                             <span
                                 class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-full bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300">
                                 <i class="fas fa-check-circle"></i>
                                 Selesai
                             </span>
                         </td>
                         <td class="px-6 py-4 text-center">
                             <span
                                 class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-full bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300">
                                 <i class="fas fa-check-circle"></i>
                                 Disetujui
                             </span>
                         </td>
                     </tr>
                 </tbody>
             </table>
         </div>

     </div>
     </div>
