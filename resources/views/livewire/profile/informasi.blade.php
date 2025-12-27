<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Informasi Akun</h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm">Perbarui informasi profil dan password akun Anda.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <form wire:submit="update" class="p-6 md:p-8">
            <!-- Avatar Section -->
            <div class="flex items-center gap-6 mb-8 border-b border-gray-100 dark:border-gray-700 pb-8">
                <div class="relative">
                    <input type="file" wire:model="photo" id="photo-upload" class="hidden" accept="image/*">
                    <label for="photo-upload" class="block relative w-20 h-20 rounded-full cursor-pointer group">
                        <div
                            class="w-full h-full rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden border border-gray-200 dark:border-gray-600 relative">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" alt="Preview"
                                    class="w-full h-full object-cover">
                            @elseif ($user->profile_path)
                                <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->username }}"
                                    class="w-full h-full object-cover group-hover:opacity-75 transition-opacity">
                            @else
                                <i
                                    class="fas fa-user text-3xl text-gray-400 dark:text-gray-500 group-hover:text-gray-500 transition-colors"></i>
                            @endif

                            <!-- Hover Overlay -->
                            <div
                                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-camera text-white text-lg"></i>
                            </div>

                        </div>

                        <!-- Loading Indicator -->
                        <div wire:loading.flex wire:target="photo"
                            class="absolute inset-0 z-50 items-center justify-center bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-full">
                            <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </label>
                    @error('photo')
                        <span class="absolute top-24 left-0 w-64 text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->username }}</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Klik foto untuk mengganti (Max 1MB)</p>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Username -->
                <div>
                    <label for="username"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" id="username" wire:model="username"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400">
                    @error('username')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" id="email" wire:model="email"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-700 pt-8 mb-8">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Ganti Password</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Password -->
                    <div class="md:col-span-2">
                        <label for="current_password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password Saat
                            Ini</label>
                        <input type="password" id="current_password" wire:model="current_password"
                            class="w-full md:w-1/2 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400"
                            placeholder="Isi jika ingin mengubah password">
                        @error('current_password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password
                            Baru</label>
                        <input type="password" id="password" wire:model="password"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi
                            Password</label>
                        <input type="password" id="password_confirmation" wire:model="password_confirmation"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all placeholder-gray-400"
                            placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="flex justify-start sm:justify-end pt-2">
                <button type="submit" wire:loading.class="text-transparent transition-none" wire:target="update"
                    class="relative px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center min-w-[120px]">
                    <span>Simpan Perubahan</span>
                    <span wire:loading.flex wire:target="update"
                        class="absolute inset-0 items-center justify-center hidden text-white">
                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
