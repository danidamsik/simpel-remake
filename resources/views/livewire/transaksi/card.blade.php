<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <!-- Pengeluaran -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-5">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Pengeluaran</h3>
        </div>
        <p class="text-2xl -mt-2 font-bold text-gray-900 dark:text-white">
            Rp {{ number_format($totalExpenses, 0, ',', '.') }}
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            {{ $totalBudget > 0 ? number_format(($totalExpenses / $totalBudget) * 100, 1) : 0 }}% dari anggaran
        </p>
    </div>

    <!-- Total Pajak -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-5">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path>
            </svg>
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pajak</h3>
        </div>
        <p class="text-2xl font-bold text-gray-900 -mt-2 dark:text-white">
            Rp {{ number_format($totalTax, 0, ',', '.') }}
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            {{ $totalExpenses > 0 ? number_format(($totalTax / $totalExpenses) * 100, 1) : 0 }}% dari pengeluaran
        </p>
    </div>

    <!-- Sisa Dana -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-5">
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Sisa Dana</h3>
        </div>
        <p class="text-2xl font-bold text-emerald-600 -mt-2 dark:text-emerald-400">
            Rp {{ number_format($remainingBalance, 0, ',', '.') }}
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            {{ $totalBudget > 0 ? number_format(($remainingBalance / $totalBudget) * 100, 1) : 0 }}% tersedia
        </p>
    </div>

</div>