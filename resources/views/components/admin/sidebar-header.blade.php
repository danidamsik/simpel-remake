<div
    class="flex items-center justify-between h-20 px-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-primary-50 to-primary-100 dark:from-gray-800 dark:to-gray-800">
    <div class="flex items-center space-x-3">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-md overflow-hidden bg-white">
            <img src="{{ Storage::url('logo-uin.png') }}" alt="Logo UIN" class="w-full h-full object-contain p-1">
        </div>
        <div>
            <span class="text-xl font-bold text-gray-800 dark:text-white">SIMPEL</span>
            <p class="text-xs text-primary-600 dark:text-primary-400 font-medium">Finance Management</p>
        </div>
    </div>
    <button @click="sidebarOpen = false"
        class="lg:hidden text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
