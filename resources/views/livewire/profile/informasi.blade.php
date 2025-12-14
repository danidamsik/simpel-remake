<div>
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <i class="fas fa-user-circle text-3xl text-blue-600 dark:text-blue-400"></i>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">Profile Saya</h1>
        </div>
        <p class="text-gray-600 dark:text-gray-300 text-sm md:text-base">Kelola informasi profil dan keamanan akun
            Anda</p>
    </div>

    <!-- Card Container: Wrapper untuk form profile -->
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">

        <!-- Profile Header: Banner dengan avatar dan role badge -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <!-- Avatar placeholder dengan ikon user -->
                <div
                    class="w-24 h-24 md:w-28 md:h-28 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow-lg overflow-hidden">
                    @if ($user->profile_path)
                        <img src="{{ asset('storage/profile/' . $user->profile_path) }}" alt="{{ $user->username }}"
                            class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-user text-5xl md:text-6xl text-blue-500 dark:text-blue-400"></i>
                    @endif
                </div>

                <!-- Info singkat user di banner -->
                <div class="text-center md:text-left text-white">
                    <h2 class="text-xl md:text-2xl font-bold mb-1">{{ $user->username }}</h2>
                    <p class="text-blue-100 dark:text-blue-200 text-sm md:text-base mb-2">{{ $user->email }}</p>
                    <!-- Badge role user -->
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 bg-white/20 dark:bg-black/20 backdrop-blur-sm rounded-full text-xs md:text-sm font-medium">
                        <i class="fas fa-shield-alt"></i>
                        {{ $user->role }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Form Section: Input fields untuk edit profile -->
        <form class="p-6 md:p-8" x-data="profileForm()">

            <!-- Section: Informasi Dasar -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-id-card text-blue-600 dark:text-blue-400"></i>
                    Informasi Dasar
                </h3>

                <!-- Grid untuk input fields responsif -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Input Username -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-user text-gray-400 dark:text-gray-500 mr-1"></i>
                            Username
                        </label>
                        <input type="text" value="{{ $user->username }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition duration-200 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                            placeholder="Masukkan username">
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-envelope text-gray-400 dark:text-gray-500 mr-1"></i>
                            Email
                        </label>
                        <input type="email" value="{{ $user->email }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition duration-200 outline-none bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                            placeholder="Masukkan email">
                    </div>

                    <!-- Input Role (readonly/disabled) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-user-tag text-gray-400 dark:text-gray-500 mr-1"></i>
                            Role
                        </label>
                        <input type="text" value="{{ $user->role }}" disabled
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-gray-400 cursor-not-allowed">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-info-circle"></i>
                            Role tidak dapat diubah sendiri
                        </p>
                    </div>

                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700 my-8"></div>

            <!-- Section: Keamanan Akun -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-lock text-blue-600 dark:text-blue-400"></i>
                    Keamanan Akun
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Input Password Lama -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-key text-gray-400 dark:text-gray-500 mr-1"></i>
                            Password Lama
                        </label>
                        <div class="relative">
                            <input :type="showOldPassword ? 'text' : 'password'" x-model="oldPassword"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition duration-200 outline-none pr-10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="Masukkan password lama">
                            <!-- Toggle visibility icon -->
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"
                                @click="showOldPassword = !showOldPassword">
                                <i class="fas" :class="showOldPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Input Password Baru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-lock text-gray-400 dark:text-gray-500 mr-1"></i>
                            Password Baru
                        </label>
                        <div class="relative">
                            <input :type="showNewPassword ? 'text' : 'password'" x-model="newPassword"
                                @input="checkPasswordStrength"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition duration-200 outline-none pr-10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="Masukkan password baru">
                            <!-- Toggle visibility icon -->
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"
                                @click="showNewPassword = !showNewPassword">
                                <i class="fas" :class="showNewPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                        <!-- Password strength indicator -->
                        <div class="mt-2 space-y-1">
                            <div class="flex gap-1">
                                <template x-for="i in 4" :key="i">
                                    <div class="h-1 flex-1 rounded transition-all duration-300"
                                        :class="{
                                            'bg-red-400': passwordStrength === 1 && i === 1,
                                            'bg-orange-400': passwordStrength === 2 && i <= 2,
                                            'bg-yellow-400': passwordStrength === 3 && i <= 3,
                                            'bg-green-500': passwordStrength === 4 && i <= 4,
                                            'bg-gray-200 dark:bg-gray-600': i > passwordStrength
                                        }">
                                    </div>
                                </template>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                <i class="fas fa-info-circle"></i>
                                <span x-text="passwordHint"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Input Konfirmasi Password Baru -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-check-circle text-gray-400 dark:text-gray-500 mr-1"></i>
                            Konfirmasi Password Baru
                        </label>
                        <div class="relative">
                            <input :type="showConfirmPassword ? 'text' : 'password'" x-model="confirmPassword"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent transition duration-200 outline-none pr-10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="Konfirmasi password baru">
                            <!-- Toggle visibility icon -->
                            <button type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400"
                                @click="showConfirmPassword = !showConfirmPassword">
                                <i class="fas" :class="showConfirmPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                        <!-- Password match indicator -->
                        <p x-show="newPassword && confirmPassword" class="text-xs mt-1">
                            <i class="fas"
                                :class="passwordMatches ? 'fa-check text-green-500 dark:text-green-400' :
                                    'fa-times text-red-500 dark:text-red-400'"></i>
                            <span
                                :class="passwordMatches ? 'text-green-600 dark:text-green-400' :
                                    'text-red-600 dark:text-red-400'">
                                <span x-text="passwordMatches ? 'Password cocok' : 'Password tidak cocok'"></span>
                            </span>
                        </p>
                    </div>

                </div>
            </div>

            <!-- Action Buttons: Tombol simpan dan batal -->
            <div class="flex flex-col sm:flex-row gap-3 justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                <!-- Tombol Batal -->
                <button type="button"
                    class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200 font-medium flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <!-- Tombol Simpan Perubahan -->
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition duration-200 font-medium shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

    <!-- Info Card: Tips keamanan akun -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
        <div class="flex items-start gap-3">
            <i class="fas fa-lightbulb text-blue-600 dark:text-blue-400 text-xl mt-0.5"></i>
            <div>
                <h4 class="font-semibold text-blue-900 dark:text-blue-300 mb-1">Tips Keamanan</h4>
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    Gunakan password yang kuat dan unik. Ubah password secara berkala untuk menjaga keamanan akun
                    Anda.
                </p>
            </div>
        </div>
    </div>
</div>
