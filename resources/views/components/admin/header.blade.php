<header
    class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-100 dark:border-gray-700 z-10 transition-colors duration-300">
    <div class="flex items-center justify-between h-16 px-6">
        <!-- Mobile Menu Button -->
        <button @click="sidebarOpen = true"
            class="lg:hidden text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <div class="flex-1 lg:ml-0 ml-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white capitalize" x-data="{
                title: (() => {
                    const segments = location.pathname.split('/').filter(Boolean);
                    const lastNonNumeric = segments.filter(s => isNaN(s)).pop();
                    return lastNonNumeric?.replace(/-/g, ' ') || 'Dashboard';
                })()
            }"
                x-on:livewire:navigated.window="
                    const segments = location.pathname.split('/').filter(Boolean);
                    const lastNonNumeric = segments.filter(s => isNaN(s)).pop();
                    title = lastNonNumeric?.replace(/-/g, ' ') || 'Dashboard';
                "
                x-text="title">
            </h1>
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
            @include('components.admin.dark-mode-toggle')
            @include('components.admin.user-menu')
        </div>
    </div>
</header>
