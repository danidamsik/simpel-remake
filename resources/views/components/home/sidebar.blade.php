<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-800 shadow-xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
    <!-- Logo / Brand -->
    <div
        class="flex items-center justify-center h-20 shadow-md bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-slate-900 dark:to-slate-800 text-white">
        <h1 class="text-3xl font-extrabold tracking-wider">
            S<span class="text-indigo-200">IMPEL</span>
        </h1>
    </div>

    <!-- Nav Links -->
    <nav class="p-4 space-y-2 mt-4">
        <a href="/home" wire:navigate
            class="flex items-center p-3 text-slate-600 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('home*') ? 'bg-indigo-50 dark:bg-slate-700 text-indigo-600 dark:text-white font-semibold shadow-sm' : '' }}">
            <div
                class="p-2 mr-3 bg-white dark:bg-slate-800 rounded-lg shadow-sm group-hover:shadow text-indigo-500 {{ request()->is('home*') ? 'text-indigo-600' : '' }}">
                <i class="fas fa-home text-lg"></i>
            </div>
            Beranda
        </a>


        <a href="/my-profile" wire:navigate
            class="flex items-center p-3 text-slate-600 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('my-profile*') ? 'bg-indigo-50 dark:bg-slate-700 text-indigo-600 dark:text-white font-semibold shadow-sm' : '' }}">
            <div
                class="p-2 mr-3 bg-white dark:bg-slate-800 rounded-lg shadow-sm group-hover:shadow text-purple-500 {{ request()->is('my-profile*') ? 'text-purple-600' : '' }}">
                <i class="fas fa-user-circle text-lg"></i>
            </div>
            Profil Saya
        </a>
    </nav>

    <!-- Logout Area -->
    <div class="absolute bottom-0 w-full p-4 border-t border-slate-200 dark:border-slate-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center justify-center w-full p-3 text-slate-600 dark:text-slate-300 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 rounded-xl transition-all duration-200 group font-medium">
                <i class="fas fa-sign-out-alt mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
    class="fixed inset-0 z-40 bg-black/50 lg:hidden glass"></div>
