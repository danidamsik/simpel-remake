<div x-show="activeTab === 'lembaga'" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100">Data Lembaga</h2>
            <p class="text-gray-600 dark:text-gray-300 text-sm">Kelola informasi lembaga dan bendahara</p>
        </div>

        <!-- Button Tambah Lembaga -->
        <button @click="openModal()"
            class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center justify-center gap-2 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Lembaga
        </button>
    </div>

    <!-- Table Data Lembaga -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full">

            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Logo</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Nama</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Lembaga</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Bendahara</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Telepon</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Email</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Total Dana</th>
                    <th
                        class="py-3 px-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <td class="py-3 px-4">
                        <div
                            class="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <span class="text-white font-bold">B</span>
                        </div>
                    </td>

                    <td class="py-3 px-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">BEM Fakultas Teknik</div>
                    </td>

                    <td class="py-3 px-4">
                        <span class="text-sm text-gray-900 dark:text-gray-100">BEM</span>
                    </td>

                    <td class="py-3 px-4">
                        <div class="text-sm text-gray-900 dark:text-gray-100">Andi Rahman</div>
                    </td>

                    <td class="py-3 px-4">
                        <div class="text-sm text-gray-900 dark:text-gray-100">0812-3456-7890</div>
                    </td>

                    <td class="py-3 px-4">
                        <div class="text-sm text-gray-900 dark:text-gray-100">bem.ft@univ.ac.id</div>
                    </td>

                    <td class="py-3 px-4">
                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">Rp 50.000.000</div>
                    </td>

                    <td class="py-3 px-4">
                        <div class="flex items-center gap-2">

                            <button
                                class="text-blue-600 hover:text-blue-800 p-1.5 hover:bg-blue-50 dark:text-blue-400 dark:hover:text-blue-300 dark:hover:bg-blue-900 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                            <button
                                class="text-red-600 hover:text-red-800 p-1.5 hover:bg-red-50 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @include('livewire.master-data.component.modal-form-lembaga')
</div>

<!-- TAMBAHKAN SCRIPT INI DI BAWAH -->
<script>
    // Script untuk membuat fungsi openModal() tersedia secara global
    document.addEventListener('DOMContentLoaded', function() {
        // Buat fungsi global openModal()
        window.openModal = function() {
            // Dispatch event ke modal
            window.dispatchEvent(new CustomEvent('open-modal-lembaga'));
        };
    });
</script>
