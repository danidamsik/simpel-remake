<aside class="fixed top-0 left-0 z-50 h-screen transition-all duration-300 ease-in-out"
    :class="sidebarExpanded ? 'w-72' : 'w-20'" x-show="sidebarOpen || window.innerWidth >= 1024"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full">
    <div class="h-full glass-effect border-r border-white/20 shadow-2xl flex flex-col">

        <!-- Logo Section with Gradient -->
        <div class="h-20 flex items-center justify-between px-6 gradient-animate">
            <div class="flex items-center space-x-3" x-show="sidebarExpanded">
                <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <i data-lucide="wallet" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg leading-tight">ORMAWA</h1>
                    <p class="text-white/80 text-xs">UIN Datokarama Palu</p>
                </div>
            </div>
            <div x-show="!sidebarExpanded" class="mx-auto">
                <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <i data-lucide="wallet" class="w-6 h-6 text-white"></i>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            <!-- Dashboard Menu -->
            <a href="/dashboard"
                class="group flex items-center px-4 py-3.5 rounded-xl font-medium text-sm transition-all {{ request()->is('dashboard*') ? 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-white/60' }}"
                :class="sidebarExpanded ? 'space-x-3' : 'justify-center'">
                <i data-lucide="layout-dashboard" class="w-6 h-6 flex-shrink-0"></i>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Dashboard</span>
            </a>

            <!-- Pengajuan Kegiatan -->
            <a href="/pengajuan-kegiatan"
                class="group flex items-center px-4 py-3.5 rounded-xl font-medium text-sm transition-all {{ request()->is('pengajuan-kegiatan*') ? 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-white/60' }}"
                :class="sidebarExpanded ? 'space-x-3' : 'justify-center'">
                <i data-lucide="file-text" class="w-6 h-6 flex-shrink-0"></i>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Pengajuan Kegiatan</span>
            </a>

            <!-- Laporan & Rekap -->
            <a href="/laporan-rekap"
                class="group flex items-center px-4 py-3.5 rounded-xl font-medium text-sm transition-all {{ request()->is('laporan-rekap*') ? 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-white/60' }}"
                :class="sidebarExpanded ? 'space-x-3' : 'justify-center'">
                <i data-lucide="bar-chart-3" class="w-6 h-6 flex-shrink-0"></i>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Laporan & Rekap</span>
            </a>

            <!-- Transaksi -->
            <a href="/transaksi"
                class="group flex items-center px-4 py-3.5 rounded-xl font-medium text-sm transition-all {{ request()->is('transaksi*') ? 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-white/60' }}"
                :class="sidebarExpanded ? 'space-x-3' : 'justify-center'">
                <i data-lucide="credit-card" class="w-6 h-6 flex-shrink-0"></i>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Transaksi</span>
            </a>

            <!-- Master Data -->
            <a href="/master-data"
                class="group flex items-center px-4 py-3.5 rounded-xl font-medium text-sm transition-all {{ request()->is('master-data*') ? 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-white/60' }}"
                :class="sidebarExpanded ? 'space-x-3' : 'justify-center'">
                <i data-lucide="database" class="w-6 h-6 flex-shrink-0"></i>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Master Data</span>
            </a>

            <!-- Profil -->
            <a href="/profil"
                class="group flex items-center px-4 py-3.5 rounded-xl font-medium text-sm transition-all {{ request()->is('profil*') ? 'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg shadow-blue-500/30' : 'text-gray-700 hover:bg-white/60' }}"
                :class="sidebarExpanded ? 'space-x-3' : 'justify-center'">
                <i data-lucide="user-circle" class="w-6 h-6 flex-shrink-0"></i>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Profil</span>
            </a>

            <!-- Divider -->
            <div class="pt-4 pb-2">
                <div class="h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            </div>

            <!-- Settings -->
            <a href="#"
                class="group flex items-center px-4 py-3.5 rounded-xl font-medium text-sm text-gray-700 hover:bg-white/60 transition-all"
                :class="sidebarExpanded ? 'space-x-3' : 'justify-center'">
                <i data-lucide="settings" class="w-6 h-6 flex-shrink-0"></i>
                <span x-show="sidebarExpanded" class="whitespace-nowrap">Pengaturan</span>
            </a>

        </nav>

        <!-- User Profile Section -->
        <div class="p-4 border-t border-white/20">
            <div class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-white/40 backdrop-blur-sm">
                <div class="relative">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                        AD
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                    </div>
                </div>
                <div class="flex-1 min-w-0" x-show="sidebarExpanded">
                    <p class="text-sm font-semibold text-gray-900 truncate">Admin User</p>
                    <p class="text-xs text-gray-500 truncate">admin@ormawa.ac.id</p>
                </div>
                <button class="text-gray-400 hover:text-gray-600" x-show="sidebarExpanded">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Collapse Button -->
        <button @click="sidebarExpanded = !sidebarExpanded"
            class="hidden lg:flex absolute -right-3 top-24 w-6 h-6 bg-white rounded-full shadow-lg items-center justify-center text-gray-600 hover:text-blue-600 border border-gray-200">
            <i data-lucide="chevron-left" class="w-4 h-4 transition-transform"
                :class="!sidebarExpanded && 'rotate-180'"></i>
        </button>
    </div>
</aside>
