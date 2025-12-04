 <div class="max-w-7xl mx-auto mb-8">
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

         <!-- Card 1 - Total Proposal -->
         <div
             class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center space-x-3">
                 <div class="p-2.5 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg">
                     <i class="fas fa-file-alt text-white text-lg"></i>
                 </div>
                 <div>
                     <p class="text-gray-600 dark:text-gray-400 text-xs font-medium">Total Proposal</p>
                     <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalProposals }}</h2>
                 </div>
             </div>
         </div>

         <!-- Card 2 - Kegiatan Berjalan -->
         <div
             class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center space-x-3">
                 <div class="p-2.5 bg-gradient-to-br from-green-500 to-green-600 rounded-lg">
                     <i class="fas fa-tasks text-white text-lg"></i>
                 </div>
                 <div>
                     <p class="text-gray-600 dark:text-gray-400 text-xs font-medium">Kegiatan Berjalan</p>
                     <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalRunningActivities }}</h2>
                 </div>
             </div>
         </div>

         <!-- Card 3 - LPJ Disetujui -->
         <div
             class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center space-x-3">
                 <div class="p-2.5 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg">
                     <i class="fas fa-check-circle text-white text-lg"></i>
                 </div>
                 <div>
                     <p class="text-gray-600 dark:text-gray-400 text-xs font-medium">LPJ Disetujui</p>
                     <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $lpjApproved }}</h2>
                 </div>
             </div>
         </div>

         <!-- Card 4 - LPJ Menunggu -->
         <div
             class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center space-x-3">
                 <div class="p-2.5 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg">
                     <i class="fas fa-clock text-white text-lg"></i>
                 </div>
                 <div>
                     <p class="text-gray-600 dark:text-gray-400 text-xs font-medium">LPJ Menunggu</p>
                     <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $lpjPending }}</h2>
                 </div>
             </div>
         </div>

         <!-- Card 6 - Total Pengeluaran -->
         <div
             class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center space-x-3">
                 <div class="p-2.5 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg">
                     <i class="fas fa-money-bill-wave text-white text-lg"></i>
                 </div>
                 <div>
                     <p class="text-gray-600 dark:text-gray-400 text-xs font-medium">Total Pengeluaran</p>
                     <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                         {{ $this->formatCurrency($totalExpenses) }}</h2>
                 </div>
             </div>
         </div>

         <!-- Card 7 - Total Pajak -->
         <div
             class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
             <div class="flex items-center space-x-3">
                 <div class="p-2.5 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg">
                     <i class="fas fa-receipt text-white text-lg"></i>
                 </div>
                 <div>
                     <p class="text-gray-600 dark:text-gray-400 text-xs font-medium">Total Pajak</p>
                     <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $this->formatCurrency($totalTax) }}
                     </h2>
                 </div>
             </div>
         </div>
     </div>
 </div>
