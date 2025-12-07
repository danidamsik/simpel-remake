<div x-data="modalUser()" @open-modal-user.window="openModal()" x-cloak wire:ignore style="display: none;"
    x-show="true">

    <!-- Modal Overlay -->
    <div x-show="showModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-3 md:p-4 bg-black/40 backdrop-blur-sm"
        @click.self="closeModal()" style="display: none;">

        <!-- Modal Container -->
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95 translate-y-8"
            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 transform scale-95 translate-y-8"
            class="relative w-full max-w-[95vw] sm:max-w-md md:max-w-lg lg:max-w-2xl mx-2 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl rounded-xl sm:rounded-2xl shadow-xl sm:shadow-2xl overflow-hidden border border-white/20 dark:border-gray-700/30 max-h-[90vh] flex flex-col"
            @keydown.escape.window="closeModal()">

            <!-- Header Tanpa Gradient -->
            <div
                class="px-4 sm:px-6 lg:px-8 py-4 sm:py-6 border-b dark:border-gray-700 bg-white dark:bg-gray-900 flex-shrink-0">
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-2 sm:gap-3 lg:gap-4 flex-wrap">
                        <div class="p-2 sm:p-3 rounded-lg sm:rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-blue-600 dark:text-blue-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3
                                class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 dark:text-gray-100 truncate">
                                <span x-text="isEditMode ? 'Edit Bendahara' : 'Tambah Bendahara Baru'"></span>
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mt-0.5 sm:mt-1 truncate">
                                Isi data bendahara berikut
                            </p>
                        </div>
                    </div>

                    <button @click="closeModal()"
                        class="p-1.5 sm:p-2 lg:p-2.5 rounded-lg sm:rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-300 flex-shrink-0 ml-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-3 sm:p-4 lg:p-6 overflow-y-auto custom-scroll flex-1">
                <form @submit.prevent="submitForm()" class="space-y-4 sm:space-y-6 lg:space-y-8">

                    <!-- Section 1: Profil & Data Dasar -->
                    <div
                        class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-lg sm:rounded-xl lg:rounded-2xl p-4 sm:p-5 lg:p-6 border border-gray-100 dark:border-gray-700">
                        <h4
                            class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 sm:mb-4 lg:mb-6">
                            Data Bendahara
                        </h4>

                        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                            <!-- Upload Foto Profil -->
                            <div class="lg:col-span-1">
                                <div class="space-y-3 sm:space-y-4">
                                    <label
                                        class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Foto Profil
                                    </label>

                                    <div x-show="formData.profilePreview"
                                        class="relative group mx-auto lg:mx-0 max-w-[200px]">
                                        <img :src="formData.profilePreview" alt="Profil Preview"
                                            class="w-full h-auto max-h-[200px] aspect-square rounded-xl sm:rounded-2xl object-cover border-2 sm:border-3 lg:border-4 border-white dark:border-gray-800 shadow-md sm:shadow-lg">
                                        <button type="button" @click="removeProfile()"
                                            class="absolute top-1.5 right-1.5 sm:top-2 sm:right-2 lg:top-3 lg:right-3 p-1 sm:p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-300 shadow-md sm:shadow-lg">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div x-show="!formData.profilePreview" @click="$refs.profileInput.click()"
                                        class="cursor-pointer group mx-auto lg:mx-0 max-w-[200px]">
                                        <div
                                            class="w-full h-auto max-h-[200px] aspect-square border-2 sm:border-3 border-dashed border-gray-300 dark:border-gray-600 rounded-xl sm:rounded-2xl flex flex-col items-center justify-center gap-2 sm:gap-3 lg:gap-4 p-3 sm:p-4 transition-all duration-300 group-hover:border-blue-500 dark:group-hover:border-blue-400 group-hover:bg-blue-50 dark:group-hover:bg-blue-900/20">
                                            <div
                                                class="p-2 sm:p-3 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500">
                                                <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8 text-white"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <span
                                                    class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 truncate">
                                                    Upload Foto
                                                </span>
                                                <span
                                                    class="block text-xs text-gray-500 dark:text-gray-400 mt-0.5 sm:mt-1 text-center">
                                                    PNG, JPG<br>(max 2MB)
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="file" x-ref="profileInput" @change="handleProfileUpload"
                                        accept="image/*" class="hidden">

                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                                        Kosongkan jika ingin menggunakan inisial
                                    </p>
                                </div>
                            </div>

                            <!-- Data User -->
                            <div class="lg:col-span-2 mt-4 lg:mt-0">
                                <div class="space-y-4 sm:space-y-5 lg:space-y-6">
                                    <!-- Username -->
                                    <div class="space-y-1.5 sm:space-y-2">
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Username
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <input type="text" x-model="formData.username"
                                                @input="validateUsername()"
                                                class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500"
                                                placeholder="Masukkan username">
                                        </div>
                                        <p x-show="errors.username" x-text="errors.username"
                                            class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                                    </div>

                                    <!-- Email -->
                                    <div class="space-y-1.5 sm:space-y-2">
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Email
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <input type="email" x-model="formData.email" @input="validateEmail()"
                                                class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                                placeholder="email@example.com">
                                        </div>
                                        <p x-show="errors.email" x-text="errors.email"
                                            class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                                    </div>

                                    <!-- Lembaga -->
                                    <div class="space-y-1.5 sm:space-y-2">
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Lembaga
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </div>
                                            <select x-model="formData.lembaga"
                                                class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none transition-all duration-300 cursor-pointer">
                                                <option value="">Pilih Lembaga</option>
                                                <option value="BEM FT">BEM FT</option>
                                                <option value="BEM FMIPA">BEM FMIPA</option>
                                                <option value="BEM FEB">BEM FEB</option>
                                                <option value="DPM">DPM</option>
                                                <option value="HIMA TI">HIMA TI</option>
                                                <option value="UKM Olahraga">UKM Olahraga</option>
                                            </select>
                                        </div>
                                        <p x-show="errors.lembaga" x-text="errors.lembaga"
                                            class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Password -->
                    <div
                        class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-lg sm:rounded-xl lg:rounded-2xl p-4 sm:p-5 lg:p-6 border border-gray-100 dark:border-gray-700">
                        <h4
                            class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 sm:mb-4 lg:mb-6">
                            Password
                        </h4>

                        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                            <!-- Password -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Password
                                    <span x-show="!isEditMode" class="text-red-500">*</span>
                                    <span x-show="isEditMode" class="text-gray-500 text-xs">(isi jika ingin
                                        mengubah)</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input :type="showPassword ? 'text' : 'password'" x-model="formData.password"
                                        @input="validatePasswordStrength(); checkPasswordMatch()"
                                        class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                        :placeholder="isEditMode ? 'Kosongkan jika tidak ingin mengubah' : 'Masukkan password'">
                                    <button type="button" @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 pr-3 sm:pr-4 flex items-center">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path x-show="!showPassword" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path x-show="!showPassword" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            <path x-show="showPassword" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Password Strength Indicator -->
                                <div x-show="formData.password && (!isEditMode || (isEditMode && formData.password))"
                                    class="mt-2 space-y-1">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs font-medium text-gray-600 dark:text-gray-400">
                                            Kekuatan password:
                                        </span>
                                        <span x-text="passwordStrengthText" :class="passwordStrengthClass"
                                            class="text-xs font-semibold px-2 py-0.5 rounded">
                                        </span>
                                    </div>

                                    <!-- Strength Bar -->
                                    <div
                                        class="h-1.5 w-full bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div :class="passwordStrengthBarClass"
                                            class="h-full transition-all duration-500 ease-out"
                                            :style="'width: ' + passwordStrengthPercentage + '%'">
                                        </div>
                                    </div>

                                    <!-- Requirements -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mt-2">
                                        <div class="flex items-center">
                                            <svg class="h-3 w-3 mr-1.5"
                                                :class="passwordRequirements.minLength ? 'text-green-500' :
                                                    'text-gray-300 dark:text-gray-600'"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-xs"
                                                :class="passwordRequirements.minLength ? 'text-green-600 dark:text-green-400' :
                                                    'text-gray-500 dark:text-gray-400'">
                                                Minimal 8 karakter
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="h-3 w-3 mr-1.5"
                                                :class="passwordRequirements.hasNumber ? 'text-green-500' :
                                                    'text-gray-300 dark:text-gray-600'"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-xs"
                                                :class="passwordRequirements.hasNumber ? 'text-green-600 dark:text-green-400' :
                                                    'text-gray-500 dark:text-gray-400'">
                                                Mengandung angka
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="h-3 w-3 mr-1.5"
                                                :class="passwordRequirements.hasUppercase ? 'text-green-500' :
                                                    'text-gray-300 dark:text-gray-600'"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-xs"
                                                :class="passwordRequirements.hasUppercase ?
                                                    'text-green-600 dark:text-green-400' :
                                                    'text-gray-500 dark:text-gray-400'">
                                                Mengandung huruf besar
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="h-3 w-3 mr-1.5"
                                                :class="passwordRequirements.hasLowercase ? 'text-green-500' :
                                                    'text-gray-300 dark:text-gray-600'"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-xs"
                                                :class="passwordRequirements.hasLowercase ?
                                                    'text-green-600 dark:text-green-400' :
                                                    'text-gray-500 dark:text-gray-400'">
                                                Mengandung huruf kecil
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <p x-show="errors.password" x-text="errors.password"
                                    class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="space-y-1.5 sm:space-y-2" x-show="formData.password || !isEditMode">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Konfirmasi Password
                                    <span x-show="!isEditMode" class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <input :type="showConfirmPassword ? 'text' : 'password'"
                                        x-model="formData.password_confirmation" @input="checkPasswordMatch()"
                                        class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                        :placeholder="isEditMode ? 'Kosongkan jika tidak ingin mengubah' :
                                            'Masukkan konfirmasi password'">
                                    <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                        class="absolute inset-y-0 right-0 pr-3 sm:pr-4 flex items-center">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path x-show="!showConfirmPassword" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path x-show="!showConfirmPassword" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            <path x-show="showConfirmPassword" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Password Match Indicator -->
                                <div x-show="formData.password && formData.password_confirmation" class="mt-1">
                                    <div class="flex items-center">
                                        <svg class="h-3 w-3 mr-1.5"
                                            :class="passwordMatch ? 'text-green-500' : 'text-red-500'" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path x-show="passwordMatch" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            <path x-show="!passwordMatch" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        <span class="text-xs font-medium"
                                            :class="passwordMatch ? 'text-green-600 dark:text-green-400' :
                                                'text-red-600 dark:text-red-400'">
                                            <span
                                                x-text="passwordMatch ? 'Password cocok' : 'Password tidak cocok'"></span>
                                        </span>
                                    </div>
                                </div>

                                <p x-show="errors.password_confirmation" x-text="errors.password_confirmation"
                                    class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Info Tips -->
                    <div
                        class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg sm:rounded-xl lg:rounded-2xl p-3 sm:p-4 lg:p-5 border border-blue-100 dark:border-blue-800/30">
                        <div class="flex items-start gap-2 sm:gap-3">
                            <div
                                class="p-1.5 sm:p-2 rounded-md sm:rounded-lg bg-blue-100 dark:bg-blue-800/30 flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 dark:text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold">Tips:</span> Password yang kuat mengandung kombinasi
                                    huruf besar, kecil, angka, dan minimal 8 karakter.
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 sm:mt-2">
                                    Pastikan password dan konfirmasi password sama untuk menghindari kesalahan.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div
                class="px-4 sm:px-6 lg:px-8 py-3 sm:py-4 lg:py-6 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex-shrink-0">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-2 sm:gap-3 lg:gap-4">
                    <div class="flex items-center gap-2 sm:gap-3 order-2 sm:order-1">
                        <div class="p-1.5 sm:p-2 rounded-md sm:rounded-lg bg-gray-100 dark:bg-gray-800">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 whitespace-nowrap">
                            Data aman & terenkripsi
                        </span>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3 order-1 sm:order-2 w-full sm:w-auto">
                        <button type="button" @click="closeModal()"
                            class="flex-1 sm:flex-none px-4 sm:px-6 py-2 sm:py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg sm:rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 text-sm sm:text-base font-medium shadow-sm hover:shadow whitespace-nowrap">
                            Batalkan
                        </button>

                        <button type="button" @click="submitForm()"
                            class="flex-1 sm:flex-none px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg sm:rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 text-sm sm:text-base font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-1.5 sm:gap-2 group whitespace-nowrap">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 group-hover:rotate-12 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span x-text="isEditMode ? 'Update' : 'Simpan'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function modalUser() {
            return {
                showModal: false,
                isEditMode: false,
                editId: null,
                showPassword: false,
                showConfirmPassword: false,
                passwordStrength: 0,
                passwordStrengthPercentage: 0,
                passwordStrengthText: '',
                passwordStrengthClass: '',
                passwordStrengthBarClass: '',
                passwordRequirements: {
                    minLength: false,
                    hasNumber: false,
                    hasUppercase: false,
                    hasLowercase: false
                },
                passwordMatch: null,
                formData: {
                    username: '',
                    email: '',
                    lembaga: '',
                    password: '',
                    password_confirmation: '',
                    profile: null,
                    profilePreview: null
                },
                errors: {},

                init() {
                    this.validatePasswordStrength();
                    this.checkPasswordMatch();
                },

                openModal(userData = null) {
                    this.showModal = true;
                    document.body.classList.add('overflow-hidden');

                    if (userData) {
                        this.isEditMode = true;
                        this.editId = userData.id;
                        this.formData = {
                            username: userData.username || '',
                            email: userData.email || '',
                            lembaga: userData.lembaga || '',
                            password: '',
                            password_confirmation: '',
                            profile: null,
                            profilePreview: userData.profile || null
                        };
                    } else {
                        this.resetForm();
                    }
                },

                closeModal() {
                    this.showModal = false;
                    document.body.classList.remove('overflow-hidden');
                },

                resetForm() {
                    this.isEditMode = false;
                    this.editId = null;
                    this.showPassword = false;
                    this.showConfirmPassword = false;
                    this.passwordStrength = 0;
                    this.passwordStrengthPercentage = 0;
                    this.passwordStrengthText = '';
                    this.passwordStrengthClass = '';
                    this.passwordStrengthBarClass = '';
                    this.passwordMatch = null;
                    this.passwordRequirements = {
                        minLength: false,
                        hasNumber: false,
                        hasUppercase: false,
                        hasLowercase: false
                    };
                    this.formData = {
                        username: '',
                        email: '',
                        lembaga: '',
                        password: '',
                        password_confirmation: '',
                        profile: null,
                        profilePreview: null
                    };
                    this.errors = {};
                },

                handleProfileUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            this.showNotification('Ukuran file maksimal 2MB', 'error');
                            return;
                        }

                        if (!file.type.match('image.*')) {
                            this.showNotification('File harus berupa gambar (JPG, PNG)', 'error');
                            return;
                        }

                        this.formData.profile = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.formData.profilePreview = e.target.result;
                            this.showNotification('Foto profil berhasil diupload!', 'success');
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removeProfile() {
                    this.formData.profile = null;
                    this.formData.profilePreview = null;
                    this.showNotification('Foto profil dihapus', 'info');
                },

                validateUsername() {
                    if (!this.formData.username.trim()) {
                        this.errors.username = 'Username wajib diisi';
                        return false;
                    } else if (this.formData.username.length < 3) {
                        this.errors.username = 'Username minimal 3 karakter';
                        return false;
                    } else {
                        delete this.errors.username;
                        return true;
                    }
                },

                validateEmail() {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (!this.formData.email.trim()) {
                        this.errors.email = 'Email wajib diisi';
                        return false;
                    } else if (!emailRegex.test(this.formData.email)) {
                        this.errors.email = 'Format email tidak valid';
                        return false;
                    } else {
                        delete this.errors.email;
                        return true;
                    }
                },

                validatePasswordStrength() {
                    const password = this.formData.password;

                    if (!password) {
                        this.passwordStrength = 0;
                        this.passwordStrengthPercentage = 0;
                        this.passwordStrengthText = '';
                        this.passwordRequirements = {
                            minLength: false,
                            hasNumber: false,
                            hasUppercase: false,
                            hasLowercase: false
                        };
                        return;
                    }

                    // Reset requirements
                    const requirements = {
                        minLength: password.length >= 8,
                        hasNumber: /\d/.test(password),
                        hasUppercase: /[A-Z]/.test(password),
                        hasLowercase: /[a-z]/.test(password)
                    };

                    this.passwordRequirements = requirements;

                    // Calculate strength (0-4)
                    let strength = 0;
                    if (requirements.minLength) strength++;
                    if (requirements.hasNumber) strength++;
                    if (requirements.hasUppercase) strength++;
                    if (requirements.hasLowercase) strength++;

                    this.passwordStrength = strength;

                    // Calculate percentage (0-100%)
                    this.passwordStrengthPercentage = (strength / 4) * 100;

                    // Set strength text and colors
                    switch (strength) {
                        case 0:
                            this.passwordStrengthText = 'Sangat Lemah';
                            this.passwordStrengthClass = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
                            this.passwordStrengthBarClass = 'bg-red-500';
                            break;
                        case 1:
                            this.passwordStrengthText = 'Lemah';
                            this.passwordStrengthClass =
                                'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200';
                            this.passwordStrengthBarClass = 'bg-orange-500';
                            break;
                        case 2:
                            this.passwordStrengthText = 'Cukup';
                            this.passwordStrengthClass =
                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
                            this.passwordStrengthBarClass = 'bg-yellow-500';
                            break;
                        case 3:
                            this.passwordStrengthText = 'Kuat';
                            this.passwordStrengthClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
                            this.passwordStrengthBarClass = 'bg-blue-500';
                            break;
                        case 4:
                            this.passwordStrengthText = 'Sangat Kuat';
                            this.passwordStrengthClass =
                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                            this.passwordStrengthBarClass = 'bg-green-500';
                            break;
                    }
                },

                checkPasswordMatch() {
                    const password = this.formData.password;
                    const confirmPassword = this.formData.password_confirmation;

                    if (!password || !confirmPassword) {
                        this.passwordMatch = null;
                        return;
                    }

                    this.passwordMatch = password === confirmPassword;

                    // Update error message
                    if (confirmPassword && password !== confirmPassword) {
                        this.errors.password_confirmation = 'Konfirmasi password tidak cocok';
                    } else {
                        delete this.errors.password_confirmation;
                    }
                },

                showNotification(message, type = 'info') {
                    const notification = document.createElement('div');
                    notification.className = `fixed top-4 right-4 z-50 px-3 sm:px-4 py-2 sm:py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full max-w-[90vw] sm:max-w-md ${
                    type === 'success' ? 'bg-blue-500 text-white' :
                    type === 'error' ? 'bg-red-500 text-white' :
                    'bg-blue-500 text-white'
                }`;
                    notification.innerHTML = `
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />' :
                              type === 'error' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />' :
                              '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'}
                        </svg>
                        <span class="text-sm sm:text-base truncate">${message}</span>
                    </div>
                `;

                    document.body.appendChild(notification);

                    setTimeout(() => {
                        notification.classList.remove('translate-x-full');
                    }, 10);

                    setTimeout(() => {
                        notification.classList.add('translate-x-full');
                        setTimeout(() => {
                            if (notification.parentNode) {
                                notification.parentNode.removeChild(notification);
                            }
                        }, 300);
                    }, 3000);
                },

                validateForm() {
                    let isValid = true;

                    // Validasi username
                    if (!this.validateUsername()) {
                        isValid = false;
                    }

                    // Validasi email
                    if (!this.validateEmail()) {
                        isValid = false;
                    }

                    // Validasi lembaga
                    if (!this.formData.lembaga) {
                        this.errors.lembaga = 'Lembaga wajib dipilih';
                        isValid = false;
                    } else {
                        delete this.errors.lembaga;
                    }

                    // Validasi password untuk tambah baru
                    if (!this.isEditMode) {
                        if (!this.formData.password) {
                            this.errors.password = 'Password wajib diisi';
                            isValid = false;
                        } else if (this.formData.password.length < 8) {
                            this.errors.password = 'Password minimal 8 karakter';
                            isValid = false;
                        } else if (this.passwordStrength < 2) {
                            this.errors.password =
                            'Password terlalu lemah. Gunakan kombinasi huruf besar, kecil, dan angka';
                            isValid = false;
                        } else {
                            delete this.errors.password;
                        }

                        if (!this.formData.password_confirmation) {
                            this.errors.password_confirmation = 'Konfirmasi password wajib diisi';
                            isValid = false;
                        } else if (this.formData.password !== this.formData.password_confirmation) {
                            this.errors.password_confirmation = 'Konfirmasi password tidak cocok';
                            isValid = false;
                        } else {
                            delete this.errors.password_confirmation;
                        }
                    }

                    // Validasi password untuk edit (jika diisi)
                    if (this.isEditMode && this.formData.password) {
                        if (this.formData.password.length < 8) {
                            this.errors.password = 'Password minimal 8 karakter';
                            isValid = false;
                        } else if (this.passwordStrength < 2) {
                            this.errors.password =
                            'Password terlalu lemah. Gunakan kombinasi huruf besar, kecil, dan angka';
                            isValid = false;
                        } else {
                            delete this.errors.password;
                        }

                        if (!this.formData.password_confirmation) {
                            this.errors.password_confirmation = 'Konfirmasi password wajib diisi';
                            isValid = false;
                        } else if (this.formData.password !== this.formData.password_confirmation) {
                            this.errors.password_confirmation = 'Konfirmasi password tidak cocok';
                            isValid = false;
                        } else {
                            delete this.errors.password_confirmation;
                        }
                    }

                    return isValid;
                },

                submitForm() {
                    if (!this.validateForm()) {
                        this.showNotification('Harap periksa kembali data yang dimasukkan', 'error');
                        return;
                    }

                    const actionType = this.isEditMode ? 'diperbarui' : 'disimpan';
                    this.showNotification(`Data bendahara berhasil ${actionType}!`, 'success');

                    setTimeout(() => {
                        console.log('Data user yang disimpan:', this.formData);

                        window.dispatchEvent(new CustomEvent('user-saved', {
                            detail: {
                                ...this.formData,
                                id: this.editId,
                                isEdit: this.isEditMode
                            }
                        }));

                        this.closeModal();
                    }, 1500);
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 transparent;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark .custom-scroll::-webkit-scrollbar-thumb {
            background: #4b5563;
        }

        .dark .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #374151;
        }

        @media (max-width: 640px) {
            .max-h-[90vh] {
                max-height: 85vh;
            }

            .custom-scroll {
                -webkit-overflow-scrolling: touch;
            }

            input,
            select,
            button {
                font-size: 16px !important;
            }
        }
    </style>
</div>
