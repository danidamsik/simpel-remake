<x-layouts.app title="Profil Saya">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Profile -->
        <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm overflow-hidden">
            <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
            <div class="px-6 pb-6">
                <div class="relative flex justify-between items-end -mt-12 mb-4">
                    <div class="flex items-end gap-4">
                        <div
                            class="h-24 w-24 rounded-full bg-white dark:bg-slate-800 p-1 ring-4 ring-white dark:ring-slate-800">
                            <div
                                class="h-full w-full rounded-full bg-indigo-100 dark:bg-slate-700 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-3xl font-bold">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                        </div>
                        <div class="pb-1">
                            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">
                                {{ auth()->user()->name ?? 'Nama Pengguna' }}</h2>
                            <p class="text-slate-500 dark:text-slate-400 font-medium">
                                {{ auth()->user()->email ?? 'email@example.com' }}</p>
                        </div>
                    </div>
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm mb-1">
                        Edit Profil
                    </button>
                </div>

                <!-- Quick Stats or Badges (Optional) -->
                <div class="flex gap-4 border-t border-slate-100 dark:border-slate-700 pt-4">
                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300 text-sm">
                        <i class="fas fa-briefcase text-slate-400"></i>
                        <span>{{ auth()->user()->role ?? 'Bendahara' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300 text-sm">
                        <i class="fas fa-calendar-alt text-slate-400"></i>
                        <span>Bergabung sejak
                            {{ \Carbon\Carbon::parse(auth()->user()->created_at ?? now())->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Information -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Info -->
            <div class="md:col-span-1 space-y-6">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700">
                    <h3 class="font-bold text-slate-800 dark:text-white mb-4">Info Personal</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-xs font-semibold text-slate-400 uppercase">Nama Lengkap</label>
                            <p class="text-slate-700 dark:text-slate-300 font-medium">{{ auth()->user()->name ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-400 uppercase">Nomor HP</label>
                            <p class="text-slate-700 dark:text-slate-300 font-medium">{{ auth()->user()->phone ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-400 uppercase">Alamat</label>
                            <p class="text-slate-700 dark:text-slate-300 font-medium">
                                {{ auth()->user()->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form (Change Password / Settings) -->
            <div class="md:col-span-2 space-y-6">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700">
                    <h3 class="font-bold text-slate-800 dark:text-white mb-4">Ganti Password</h3>
                    <form action="#" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Password
                                    Saat Ini</label>
                                <input type="password"
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                    placeholder="••••••••">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Password
                                    Baru</label>
                                <input type="password"
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                    placeholder="••••••••">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Konfirmasi
                                    Password</label>
                                <input type="password"
                                    class="w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                    placeholder="••••••••">
                            </div>
                        </div>
                        <div class="pt-2 flex justify-end">
                            <button type="submit"
                                class="bg-slate-800 hover:bg-slate-900 dark:bg-indigo-600 dark:hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                                Simpan Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
