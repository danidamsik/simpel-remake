<header
    class="sticky top-0 z-30 flex items-center justify-between px-6 py-4 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md shadow-sm border-b border-slate-200 dark:border-slate-700">
    <!-- Left: Mobile Toggle & Title -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen"
            class="text-slate-500 hover:text-indigo-600 lg:hidden focus:outline-none transition-colors">
            <i class="fas fa-bars text-2xl"></i>
        </button>
        <h2 class="text-xl font-bold text-slate-800 dark:text-white hidden sm:block">
            Dashboard
        </h2>
    </div>

    <!-- Right: Actions -->
    <div class="flex items-center gap-4">
        <!-- Dark Mode Toggle -->
        <button x-data="{
            toggle() {
                if (localStorage.theme === 'dark') {
                    localStorage.theme = 'light';
                    document.documentElement.classList.remove('dark');
                } else {
                    localStorage.theme = 'dark';
                    document.documentElement.classList.add('dark');
                }
            }
        }" @click="toggle()"
            class="p-2 text-slate-400 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors rounded-full hover:bg-slate-100 dark:hover:bg-slate-700 focus:outline-none">
            <i class="fas fa-sun hidden dark:block text-xl"></i>
            <i class="fas fa-moon block dark:hidden text-xl"></i>
        </button>

        <!-- User Profile -->
        <div x-data="{ open: false }" class="relative" @click.away="open = false">
            <button @click="open = !open" class="flex items-center gap-3 focus:outline-none">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">
                        {{ auth()->user()->username ?? 'Pengguna' }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        {{ auth()->user()->email ?? 'user@example.com' }}</p>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-slate-700 flex items-center justify-center text-indigo-600 dark:text-indigo-400 ring-2 ring-white dark:ring-slate-700 shadow-sm overflow-hidden">
                    @if (auth()->user()->profile_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_path) }}"
                            alt="{{ auth()->user()->username }}" class="h-full w-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username ?? 'User') }}&background=6366f1&color=fff"
                            alt="Avatar" class="h-full w-full object-cover">
                    @endif
                </div>
            </button>

            <!-- Dropdown -->
            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700 py-1 z-50">
                <a href="{{ route('home.profile') }}"
                    class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:text-indigo-600">
                    <i class="fas fa-user-circle mr-2 w-4"></i> Profile
                </a>

                <div class="border-t border-slate-100 dark:border-slate-700 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                        <i class="fas fa-sign-out-alt mr-2 w-4"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
