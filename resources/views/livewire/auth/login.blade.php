<div class="w-full max-w-md">
    <!-- Login Card -->
    <div class="glass-effect rounded-3xl shadow-2xl p-8 md:p-10 relative z-10">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg mb-6 transform hover:scale-105 transition-transform duration-300">
                <i class="fas fa-university text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
            <p class="text-gray-500">Masuk ke SIMPEL ORMAWA</p>
        </div>

        <!-- Login Form -->
        <form wire:submit.prevent="login" class="space-y-6">
            <!-- Email Input -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-envelope mr-2 text-indigo-500"></i>Email
                </label>
                <div class="relative">
                    <input type="email" id="email" wire:model.defer="email"
                        class="input-field w-full px-5 py-4 bg-gray-50 border-2 border-gray-100 rounded-xl text-gray-700 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all duration-300"
                        placeholder="nama@email.com" autocomplete="email">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <i class="fas fa-at text-gray-300"></i>
                    </div>
                </div>
                @error('email')
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock mr-2 text-indigo-500"></i>Password
                </label>
                <div class="relative" x-data="{ showPassword: false }">
                    <input :type="showPassword ? 'text' : 'password'" id="password" wire:model.defer="password"
                        class="input-field w-full px-5 py-4 bg-gray-50 border-2 border-gray-100 rounded-xl text-gray-700 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all duration-300"
                        placeholder="Masukkan password" autocomplete="current-password">
                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors">
                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model.defer="remember"
                        class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 transition-colors cursor-pointer">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                    Lupa password?
                </a>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="btn-primary w-full py-4 px-6 rounded-xl text-white font-semibold text-lg shadow-lg flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed"
                wire:loading.attr="disabled">
                <span wire:loading.remove class="flex items-center gap-2">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </span>
                <span wire:loading.flex class="items-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Memproses...
                </span>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-400">atau</span>
            </div>
        </div>

        <!-- Alternative Login Info -->
        <div class="text-center">
            <p class="text-gray-500 text-sm">
                Belum punya akun?
                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-semibold transition-colors">
                    Hubungi Admin
                </a>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-8">
        <p class="text-white/80 text-sm">
            © {{ date('Y') }} SIMPEL ORMAWA. All rights reserved.
        </p>
    </div>
</div>
