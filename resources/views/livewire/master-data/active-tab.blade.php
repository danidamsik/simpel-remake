<div class="border-b border-gray-200 dark:border-gray-700">
    <nav class="flex overflow-x-auto">
        <!-- Tab 1: Data User -->
        <button @click="activeTab = 'user'"
            :class="activeTab === 'user'
                ?
                'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-400' :
                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
            class="px-4 md:px-6 py-3 text-sm md:text-base font-medium border-b-2 whitespace-nowrap transition-colors flex items-center">
            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2"
                :class="activeTab === 'user'
                    ?
                    'text-blue-600 dark:text-blue-400' :
                    'text-gray-400 dark:text-gray-500'"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Data Bendahara
        </button>

        <!-- Tab 2: Data Lembaga -->
        <button @click="activeTab = 'lembaga'"
            :class="activeTab === 'lembaga'
                ?
                'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-400' :
                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
            class="px-4 md:px-6 py-3 text-sm md:text-base font-medium border-b-2 whitespace-nowrap transition-colors flex items-center">
            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2"
                :class="activeTab === 'lembaga'
                    ?
                    'text-blue-600 dark:text-blue-400' :
                    'text-gray-400 dark:text-gray-500'"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Data Organisasi
        </button>

        <!-- Tab 3: Data Periode -->
        <button @click="activeTab = 'periode'"
            :class="activeTab === 'periode'
                ?
                'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-400' :
                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
            class="px-4 md:px-6 py-3 text-sm md:text-base font-medium border-b-2 whitespace-nowrap transition-colors flex items-center">
            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2"
                :class="activeTab === 'periode'
                    ?
                    'text-blue-600 dark:text-blue-400' :
                    'text-gray-400 dark:text-gray-500'"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Data Periode
        </button>
    </nav>
</div>
