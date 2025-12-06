<div x-data="modalLembagaModern()" @open-modal-lembaga.window="openModal()" x-cloak wire:ignore style="display: none;"
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
            class="relative w-full max-w-[95vw] sm:max-w-md md:max-w-lg lg:max-w-4xl mx-2 bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl rounded-xl sm:rounded-2xl shadow-xl sm:shadow-2xl overflow-hidden border border-white/20 dark:border-gray-700/30 max-h-[90vh] flex flex-col"
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
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3
                                class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 dark:text-gray-100 truncate">
                                Tambah Lembaga Baru
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mt-0.5 sm:mt-1 truncate">
                                Isi data lembaga berikut
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

                    <!-- Section 1: Logo & Nama Lembaga -->
                    <div
                        class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-lg sm:rounded-xl lg:rounded-2xl p-4 sm:p-5 lg:p-6 border border-gray-100 dark:border-gray-700">
                        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                            <!-- Logo Upload -->
                            <div class="lg:col-span-1">
                                <div class="space-y-3 sm:space-y-4">
                                    <label
                                        class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Logo Lembaga
                                        <span class="text-red-500 ml-1">*</span>
                                    </label>

                                    <div x-show="formData.logoPreview"
                                        class="relative group mx-auto lg:mx-0 max-w-[200px]">
                                        <img :src="formData.logoPreview" alt="Logo Preview"
                                            class="w-full h-auto max-h-[200px] aspect-square rounded-xl sm:rounded-2xl object-cover border-2 sm:border-3 lg:border-4 border-white dark:border-gray-800 shadow-md sm:shadow-lg">
                                        <button type="button" @click="removeLogo()"
                                            class="absolute top-1.5 right-1.5 sm:top-2 sm:right-2 lg:top-3 lg:right-3 p-1 sm:p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 transition-all duration-300 shadow-md sm:shadow-lg">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div x-show="!formData.logoPreview" @click="$refs.logoInput.click()"
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
                                                    Upload Logo
                                                </span>
                                                <span
                                                    class="block text-xs text-gray-500 dark:text-gray-400 mt-0.5 sm:mt-1 text-center">
                                                    PNG, JPG, SVG<br>(max 2MB)
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="file" x-ref="logoInput" @change="handleLogoUpload" accept="image/*"
                                        class="hidden">
                                </div>
                            </div>

                            <!-- Nama & Jenis Lembaga -->
                            <div class="lg:col-span-2 mt-4 lg:mt-0">
                                <div class="space-y-4 sm:space-y-5 lg:space-y-6">
                                    <!-- Nama Lembaga -->
                                    <div class="space-y-1.5 sm:space-y-2">
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Nama Lembaga
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
                                            <input type="text" x-model="formData.nama"
                                                class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500"
                                                placeholder="Masukkan nama lengkap lembaga">
                                        </div>
                                        <p x-show="errors.nama" x-text="errors.nama"
                                            class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                                    </div>

                                    <!-- Jenis Lembaga -->
                                    <div class="space-y-1.5 sm:space-y-2">
                                        <label
                                            class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Jenis Lembaga
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                            </div>
                                            <select x-model="formData.lembaga"
                                                class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none transition-all duration-300 cursor-pointer">
                                                <option value="">Pilih Jenis Lembaga</option>
                                                <option value="BEM">BEM</option>
                                                <option value="DPM">DPM</option>
                                                <option value="HIMA">HIMA</option>
                                                <option value="UKM">UKM</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <p x-show="errors.lembaga" x-text="errors.lembaga"
                                            class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Kontak & Dana -->
                    <div
                        class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-lg sm:rounded-xl lg:rounded-2xl p-4 sm:p-5 lg:p-6 border border-gray-100 dark:border-gray-700">
                        <h4
                            class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 sm:mb-4 lg:mb-6">
                            Data Kontak & Keuangan
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 lg:gap-6">
                            <!-- Bendahara -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Bendahara
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" x-model="formData.bendahara"
                                        class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                        placeholder="Nama bendahara">
                                </div>
                                <p x-show="errors.bendahara" x-text="errors.bendahara"
                                    class="text-xs text-red-600 dark:text-red-400"></p>
                            </div>

                            <!-- Telepon -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Telepon
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <input type="text" x-model="formData.phone"
                                        class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                        placeholder="0812-3456-7890">
                                </div>
                                <p x-show="errors.phone" x-text="errors.phone"
                                    class="text-xs text-red-600 dark:text-red-400"></p>
                            </div>

                            <!-- Email -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="email" x-model="formData.email"
                                        class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                        placeholder="email@lembaga.ac.id">
                                </div>
                                <p x-show="errors.email" x-text="errors.email"
                                    class="text-xs text-red-600 dark:text-red-400"></p>
                            </div>

                            <!-- Total Dana -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Total Dana
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" x-model="formData.totalDana"
                                        @input="formatCurrencyInput($event)"
                                        class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                        placeholder="Rp 50.000.000">
                                </div>
                                <p x-show="errors.totalDana" x-text="errors.totalDana"
                                    class="text-xs text-red-600 dark:text-red-400"></p>
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
                                    <span class="font-semibold">Tips:</span> Pastikan data yang dimasukkan akurat dan
                                    valid.
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 sm:mt-2">
                                    Semua field dengan tanda <span class="text-red-500">*</span> wajib diisi.
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
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function modalLembagaModern() {
            return {
                showModal: false,
                formData: {
                    nama: '',
                    lembaga: '',
                    bendahara: '',
                    phone: '',
                    email: '',
                    totalDana: '',
                    logo: null,
                    logoPreview: null
                },
                errors: {},

                openModal() {
                    this.showModal = true;
                    document.body.classList.add('overflow-hidden');
                    this.resetForm();
                },

                closeModal() {
                    this.showModal = false;
                    document.body.classList.remove('overflow-hidden');
                },

                resetForm() {
                    this.formData = {
                        nama: '',
                        lembaga: '',
                        bendahara: '',
                        phone: '',
                        email: '',
                        totalDana: '',
                        logo: null,
                        logoPreview: null
                    };
                    this.errors = {};
                },

                handleLogoUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            this.showNotification('Ukuran file maksimal 2MB', 'error');
                            return;
                        }

                        if (!file.type.match('image.*')) {
                            this.showNotification('File harus berupa gambar (JPG, PNG, SVG)', 'error');
                            return;
                        }

                        this.formData.logo = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.formData.logoPreview = e.target.result;
                            this.showNotification('Logo berhasil diupload!', 'success');
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removeLogo() {
                    this.formData.logo = null;
                    this.formData.logoPreview = null;
                    this.showNotification('Logo dihapus', 'info');
                },

                formatCurrencyInput(event) {
                    let value = event.target.value.replace(/\D/g, '');
                    if (value) {
                        this.formData.totalDana = 'Rp ' + new Intl.NumberFormat('id-ID').format(parseInt(value));
                    } else {
                        this.formData.totalDana = '';
                    }
                },

                showNotification(message, type = 'info') {
                    const notification = document.createElement('div');
                    notification.className = `fixed top-4 right-4 z-50 px-3 sm:px-4 py-2 sm:py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full max-w-[90vw] sm:max-w-md ${
                    type === 'success' ? 'bg-green-500 text-white' :
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

                submitForm() {
                    if (!this.formData.nama.trim()) {
                        this.showNotification('Nama lembaga wajib diisi', 'error');
                        return;
                    }

                    if (!this.formData.lembaga) {
                        this.showNotification('Jenis lembaga wajib dipilih', 'error');
                        return;
                    }

                    this.showNotification('Data lembaga berhasil disimpan!', 'success');

                    setTimeout(() => {
                        console.log('Data yang disimpan:', this.formData);

                        window.dispatchEvent(new CustomEvent('lembaga-saved', {
                            detail: this.formData
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
                /* Prevents zoom on iOS */
            }
        }
    </style>
</div>
