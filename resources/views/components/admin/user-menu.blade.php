<!-- User Menu -->
@php
    $user = auth()->user();
    $initials = 'U';
    $profilePhotoUrl = null;

    if ($user) {
        // Get initials from username
        $words = explode(' ', $user->username ?? 'User');
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        $initials = $initials ?: 'U';

        // Get profile photo URL
        if ($user->profile_path) {
            $profilePhotoUrl = Storage::url($user->profile_path);
        }
    }
@endphp

<div class="flex items-center space-x-3" x-data="{ showLogoutModal: false }">
    <!-- Profile Photo / Initials -->
    <div class="w-8 h-8 rounded-lg flex items-center justify-center shadow-sm overflow-hidden">
        @if ($profilePhotoUrl)
            <img src="{{ $profilePhotoUrl }}" alt="{{ $user->username ?? 'User' }}" class="w-full h-full object-cover">
        @else
            <div
                class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                <span class="text-white font-semibold text-xs">{{ $initials }}</span>
            </div>
        @endif
    </div>

    <!-- Logout Button -->
    <button type="button" @click="showLogoutModal = true"
        class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors"
        title="Logout">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
            </path>
        </svg>
    </button>

    <!-- Logout Confirmation Modal (Teleport to body) -->
    <template x-teleport="body">
        <div x-show="showLogoutModal" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-900/70" @click="showLogoutModal = false"></div>

            <!-- Modal Content -->
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 w-full max-w-sm mx-4 transform"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                @click.stop>
                <!-- Icon -->
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-2">
                    Konfirmasi Logout
                </h3>

                <!-- Message -->
                <p class="text-gray-500 dark:text-gray-400 text-center mb-6">
                    Apakah Anda yakin ingin keluar dari sistem?
                </p>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="button" @click="showLogoutModal = false"
                        class="flex-1 px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        Batal
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-3 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition-colors">
                            Ya, Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
