<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <!-- Logo and Institution Name -->
    <div class="flex items-center space-x-3">
        <!-- Logo Container -->
        <div
            class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl shadow-lg">
            <i class="fas fa-university text-xl sm:text-2xl text-white"></i>
        </div>

        <!-- Institution Name and Welcome -->
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white">Lembaga Kreatif</h1>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-0.5">
                <i class="fas fa-user-circle mr-1"></i>
                Selamat datang, <span class="font-medium text-blue-600 dark:text-blue-400">Jhon</span>
            </p>
        </div>
    </div>

    <!-- User Controls Section (Dark Mode Toggle and Logout) -->
    <div class="flex items-center justify-between sm:justify-start space-x-3 sm:space-x-4">
        <!-- Dark Mode Toggle with Alpine.js -->
        <div x-data="{ 
                    darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                    toggle() {
                        this.darkMode = !this.darkMode;
                        if (this.darkMode) {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('theme', 'dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('theme', 'light');
                        }
                    }
                }"
            x-init="darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')">
            <button @click="toggle()"
                class="relative w-14 h-7 sm:w-16 sm:h-8 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 dark:from-indigo-600 dark:to-purple-700 p-1 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800"
                aria-label="Toggle dark mode">
                <!-- Sun Icon (Light Mode) -->
                <span class="absolute left-1.5 top-1/2 -translate-y-1/2 text-yellow-300 transition-opacity duration-300"
                    :class="darkMode ? 'opacity-50' : 'opacity-100'">
                    <i class="fas fa-sun text-xs sm:text-sm"></i>
                </span>
                <!-- Moon Icon (Dark Mode) -->
                <span class="absolute right-1.5 top-1/2 -translate-y-1/2 text-white transition-opacity duration-300"
                    :class="darkMode ? 'opacity-100' : 'opacity-50'">
                    <i class="fas fa-moon text-xs sm:text-sm"></i>
                </span>
                <!-- Toggle Circle -->
                <span
                    class="block w-5 h-5 sm:w-6 sm:h-6 bg-white rounded-full shadow-md transition-transform duration-300"
                    :class="darkMode ? 'translate-x-7 sm:translate-x-8' : 'translate-x-0'"></span>
            </button>
        </div>

        <!-- Logout Button -->
        <button
            class="group flex items-center space-x-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white rounded-xl shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
            <i class="fas fa-sign-out-alt text-xs sm:text-sm"></i>
            <span class="font-medium text-xs sm:text-sm">Logout</span>
        </button>

        <!-- User Profile Avatar -->
        <div class="hidden sm:flex items-center space-x-3 pl-3 sm:pl-4 border-l border-gray-200 dark:border-gray-700">
            <div class="relative">
                <div
                    class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base shadow-md">
                    A
                </div>
                <div
                    class="absolute -top-1 -right-1 w-3 h-3 sm:w-4 sm:h-4 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full">
                </div>
            </div>
            <div class="hidden lg:block">
                <p class="text-sm font-medium text-gray-800 dark:text-white">Jhon Doe</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Bendahara</p>
            </div>
        </div>
    </div>
</div>