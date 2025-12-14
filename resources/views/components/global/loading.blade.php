<!-- Loading State -->
<template x-if="loading">
    <div class="text-center py-12">
        <div
            class="w-16 h-16 mx-auto rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4">
            <i class="fas fa-spinner fa-spin text-2xl text-blue-500"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Memuat data...</h3>
    </div>
</template>
