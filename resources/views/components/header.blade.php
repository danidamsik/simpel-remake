<header class="sticky top-0 z-40">
    <div class="glass-effect border-b border-white/20 shadow-sm">
        <div class="px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Left Section -->
                <div class="flex items-center space-x-4">
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden p-2 rounded-xl text-gray-600 hover:bg-white/60">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>

                    <!-- Page Title with Icon -->
                    <div class="flex items-center space-x-3">
                        <div
                            class="hidden sm:flex w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 items-center justify-center shadow-lg shadow-blue-500/30">
                            <i data-lucide="activity" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
                            <p class="text-sm text-gray-500">Monitoring Dana ORMAWA & LPJ</p>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-2">

                    <!-- Search Bar -->
                    <div
                        class="hidden md:flex items-center space-x-2 px-4 py-2.5 bg-white/60 rounded-xl border border-gray-200/50">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                        <input type="text" placeholder="Cari..."
                            class="bg-transparent border-none outline-none text-sm text-gray-700 placeholder-gray-400 w-48">
                        <kbd class="px-2 py-0.5 text-xs font-semibold text-gray-500 bg-gray-100 rounded">⌘K</kbd>
                    </div>

                    <!-- Mobile Search -->
                    <button class="md:hidden p-2.5 rounded-xl text-gray-600 hover:bg-white/60">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
