<div x-data="modalPeriode()" @open-modal-periode.window="openModal()" x-cloak wire:ignore style="display: none;"
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
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3
                                class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 dark:text-gray-100 truncate">
                                <span x-text="isEditMode ? 'Edit Periode' : 'Tambah Periode Baru'"></span>
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 mt-0.5 sm:mt-1 truncate">
                                Isi data periode berikut
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

                    <!-- Section 1: Data Periode -->
                    <div
                        class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 rounded-lg sm:rounded-xl lg:rounded-2xl p-4 sm:p-5 lg:p-6 border border-gray-100 dark:border-gray-700">
                        <h4
                            class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 sm:mb-4 lg:mb-6">
                            Data Periode
                        </h4>

                        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
                            <!-- Nama Periode -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Periode
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <input type="text" x-model="formData.name"
                                        class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder-gray-400 dark:placeholder-gray-500"
                                        placeholder="Contoh: Tahun Akademik 2023/2024">
                                </div>
                                <p x-show="errors.name" x-text="errors.name"
                                    class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                            </div>

                            <!-- Tanggal Mulai & Selesai -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 lg:gap-6">
                                <!-- Tanggal Mulai -->
                                <div class="space-y-1.5 sm:space-y-2">
                                    <label
                                        class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Tanggal Mulai
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="date" x-model="formData.start_date"
                                            class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                    </div>
                                    <p x-show="errors.start_date" x-text="errors.start_date"
                                        class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                                </div>

                                <!-- Tanggal Selesai -->
                                <div class="space-y-1.5 sm:space-y-2">
                                    <label
                                        class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Tanggal Selesai
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="date" x-model="formData.end_date"
                                            class="pl-10 sm:pl-12 w-full px-3 sm:px-4 py-2.5 sm:py-3 lg:py-3.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg sm:rounded-xl text-sm sm:text-base text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                    </div>
                                    <p x-show="errors.end_date" x-text="errors.end_date"
                                        class="text-xs text-red-600 dark:text-red-400 mt-0.5 sm:mt-1"></p>
                                </div>
                            </div>

                            <!-- Status (Radio Button Biasa) -->
                            <div class="space-y-1.5 sm:space-y-2">
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Status
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-6">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" x-model="formData.status" value="active"
                                            class="form-radio h-4 w-4 sm:h-5 sm:w-5 text-blue-600 transition duration-300 ease-in-out"
                                            name="status">
                                        <span
                                            class="ml-2 sm:ml-3 text-sm sm:text-base text-gray-700 dark:text-gray-300">
                                            Aktif
                                        </span>
                                    </label>

                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" x-model="formData.status" value="inactive"
                                            class="form-radio h-4 w-4 sm:h-5 sm:w-5 text-blue-600 transition duration-300 ease-in-out"
                                            name="status">
                                        <span
                                            class="ml-2 sm:ml-3 text-sm sm:text-base text-gray-700 dark:text-gray-300">
                                            Tidak Aktif
                                        </span>
                                    </label>
                                </div>
                                <p x-show="errors.status" x-text="errors.status"
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
                                    <span class="font-semibold">Tips:</span> Pastikan periode tidak tumpang tindih
                                    dengan periode lain.
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 sm:mt-2">
                                    Hanya satu periode yang bisa berstatus "Aktif" dalam satu waktu.
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
        function modalPeriode() {
            return {
                showModal: false,
                isEditMode: false,
                editId: null,
                formData: {
                    name: '',
                    start_date: '',
                    end_date: '',
                    status: 'active'
                },
                errors: {},

                openModal(periodeData = null) {
                    this.showModal = true;
                    document.body.classList.add('overflow-hidden');

                    if (periodeData) {
                        this.isEditMode = true;
                        this.editId = periodeData.id;
                        this.formData = {
                            name: periodeData.name || '',
                            start_date: periodeData.start_date || '',
                            end_date: periodeData.end_date || '',
                            status: periodeData.status || 'active'
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
                    this.formData = {
                        name: '',
                        start_date: '',
                        end_date: '',
                        status: 'active'
                    };
                    this.errors = {};
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
                    this.errors = {};

                    if (!this.formData.name.trim()) {
                        this.errors.name = 'Nama periode wajib diisi';
                    }

                    if (!this.formData.start_date) {
                        this.errors.start_date = 'Tanggal mulai wajib diisi';
                    }

                    if (!this.formData.end_date) {
                        this.errors.end_date = 'Tanggal selesai wajib diisi';
                    }

                    if (!this.formData.status) {
                        this.errors.status = 'Status wajib dipilih';
                    }

                    if (this.formData.start_date && this.formData.end_date) {
                        const start = new Date(this.formData.start_date);
                        const end = new Date(this.formData.end_date);

                        if (end <= start) {
                            this.errors.end_date = 'Tanggal selesai harus setelah tanggal mulai';
                        }
                    }

                    return Object.keys(this.errors).length === 0;
                },

                submitForm() {
                    if (!this.validateForm()) {
                        this.showNotification('Harap periksa kembali data yang dimasukkan', 'error');
                        return;
                    }

                    const actionType = this.isEditMode ? 'diperbarui' : 'disimpan';
                    this.showNotification(`Periode berhasil ${actionType}!`, 'success');

                    setTimeout(() => {
                        console.log('Data periode yang disimpan:', this.formData);

                        window.dispatchEvent(new CustomEvent('periode-saved', {
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

        /* Style untuk radio button */
        .form-radio:checked {
            border-color: transparent;
            background-color: #3b82f6;
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .form-radio {
            border: 2px solid #d1d5db;
            transition: all 0.3s ease-in-out;
        }

        .dark .form-radio {
            border-color: #4b5563;
            background-color: #374151;
        }

        .dark .form-radio:checked {
            border-color: transparent;
            background-color: #3b82f6;
        }
    </style>
</div>
