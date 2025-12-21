<div x-show="open" @keydown.escape.window="open = false" class="relative z-50" style="display: none;">

    <!-- Backdrop -->
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/80 backdrop-blur-sm transition-opacity"
        @click="open = false"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4">
        <div class="flex min-h-full items-end justify-center sm:items-center sm:p-4">
            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full mb-4 transform overflow-hidden bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:rounded-xl sm:my-8 sm:max-w-2xl">

                <!-- Loading State -->
                @include('components.global.loading')

                <!-- Content State -->
                <template x-if="!loading && selectedActivity">
                    <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                            <h3 class="text-xl font-semibold leading-6 text-gray-900 dark:text-gray-100"
                                x-text="selectedActivity.name"></h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400"
                                x-text="selectedActivity.organization.name"></p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Proposal Info -->
                            <div class="space-y-4">
                                <h4
                                    class="text-sm font-medium text-blue-600 dark:text-blue-400 uppercase tracking-wider">
                                    Informasi Proposal</h4>
                                <dl class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Tanggal
                                            Diterima</dt>
                                        <dd class="font-medium text-gray-900 dark:text-gray-200"
                                            x-text="formatDate(selectedActivity.proposal.date_received)">
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Dana
                                            Disetujui</dt>
                                        <dd class="font-medium text-gray-900 dark:text-gray-200"
                                            x-text="formatMoney(selectedActivity.proposal.funds_approved)">
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500 dark:text-gray-400 mb-1">File
                                            Proposal</dt>
                                        <dd>
                                            <a :href="'/storage/' + selectedActivity.proposal
                                                .proposal_file"
                                                target="_blank"
                                                class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Download Proposal
                                            </a>
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Activity Info -->
                            <div class="space-y-4">
                                <h4
                                    class="text-sm font-medium text-purple-600 dark:text-purple-400 uppercase tracking-wider">
                                    Detail Kegiatan</h4>
                                <dl class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Status
                                        </dt>
                                        <dd>
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold"
                                                :class="getStatus(selectedActivity.start_date,
                                                        selectedActivity.end_date)
                                                    .class"
                                                x-text="getStatus(selectedActivity.start_date, selectedActivity.end_date).text">
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Tanggal
                                            Mulai</dt>
                                        <dd class="font-medium text-gray-900 dark:text-gray-200"
                                            x-text="formatDate(selectedActivity.start_date)">
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Tanggal
                                            Selesai</dt>
                                        <dd class="font-medium text-gray-900 dark:text-gray-200"
                                            x-text="formatDate(selectedActivity.end_date)">
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Lokasi
                                        </dt>
                                        <dd class="font-medium text-gray-900 dark:text-gray-200"
                                            x-text="selectedActivity.location"></dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Penanggung
                                            Jawab</dt>
                                        <dd class="font-medium text-gray-900 dark:text-gray-200 text-right">
                                            <div x-text="selectedActivity.person_responsible">
                                            </div>
                                            <div class="text-xs text-gray-500" x-text="selectedActivity.number_pr">
                                            </div>
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- LPJ Info -->
                            <div class="space-y-4 md:col-span-2 border-t border-gray-200 dark:border-gray-700 pt-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h4
                                            class="text-sm font-medium text-green-600 dark:text-green-400 uppercase tracking-wider mb-2">
                                            Laporan & Keuangan</h4>
                                        <dl class="space-y-2 text-sm">
                                            <div class="flex justify-between">
                                                <dt class="text-gray-500 dark:text-gray-400">
                                                    Status LPJ</dt>
                                                <dd>
                                                    <span class="font-medium"
                                                        :class="(selectedActivity.lpj &&
                                                            selectedActivity.lpj.status ==
                                                            'Disetujui') ? 'text-green-600' :
                                                        'text-yellow-600'"
                                                        x-text="selectedActivity.lpj ? selectedActivity.lpj.status : 'Belum Ada'">
                                                    </span>
                                                </dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-gray-500 dark:text-gray-400">
                                                    Tgl Terima LPJ</dt>
                                                <dd class="font-medium text-gray-900 dark:text-gray-200"
                                                    x-text="selectedActivity.lpj ? formatDate(selectedActivity.lpj.date_received) : '-'">
                                                </dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-gray-500 dark:text-gray-400">
                                                    Total Pengeluaran</dt>
                                                <dd class="font-bold text-gray-900 dark:text-gray-200"
                                                    x-text="formatMoney(selectedActivity.expenses_sum_amount)">
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                        {{-- Jika LPJ sudah disetujui dan ada file, tampilkan download link --}}
                                        <template
                                            x-if="selectedActivity.lpj && selectedActivity.lpj.status === 'Disetujui' && selectedActivity.lpj.file">
                                            <a :href="'/storage/' + selectedActivity.lpj.file" target="_blank"
                                                class="text-center group flex flex-col items-center justify-center">
                                                <div
                                                    class="w-12 h-12 bg-white dark:bg-gray-800 rounded-full shadow flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                                                    <svg class="w-6 h-6 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                                <span
                                                    class="text-sm font-medium text-gray-900 dark:text-gray-200 group-hover:text-green-600 transition-colors">Download
                                                    File LPJ</span>
                                            </a>
                                        </template>

                                        {{-- Jika activity selesai dan LPJ belum disetor, tampilkan form upload --}}
                                        <template
                                            x-if="getStatus(selectedActivity.start_date, selectedActivity.end_date).text === 'Selesai' && (!selectedActivity.lpj || selectedActivity.lpj.status === 'Belum Disetor')">
                                            <form class="space-y-3" x-data="{ uploading: false, progress: 0 }"
                                                x-on:livewire-upload-start="uploading = true"
                                                x-on:livewire-upload-finish="uploading = false"
                                                x-on:livewire-upload-cancel="uploading = false"
                                                x-on:livewire-upload-error="uploading = false"
                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                <div class="text-center mb-3">
                                                    <div
                                                        class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-2">
                                                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                        </svg>
                                                    </div>
                                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                        Upload File LPJ</p>
                                                </div>

                                                <input type="file" wire:model="lpjFile" accept=".pdf,.doc,.docx"
                                                    class="block w-full text-sm text-gray-500 dark:text-gray-400
                                                        file:mr-4 file:py-2 file:px-4
                                                        file:rounded-lg file:border-0
                                                        file:text-sm file:font-semibold
                                                        file:bg-blue-50 file:text-blue-700
                                                        hover:file:bg-blue-100
                                                        dark:file:bg-blue-900/30 dark:file:text-blue-400" />

                                                {{-- Progress Bar --}}
                                                <div x-show="uploading"
                                                    class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                    <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300"
                                                        :style="'width: ' + progress + '%'"></div>
                                                </div>

                                                <div x-show="!$wire.lpjFile">
                                                    @error('lpjFile')
                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <button type="button" wire:click="uploadLpj(selectedActivity.id)"
                                                    wire:loading.attr="disabled"
                                                    wire:loading.class="opacity-50 cursor-not-allowed"
                                                    class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                                                    <svg wire:loading wire:target="uploadLpj"
                                                        class="animate-spin h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12"
                                                            r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    <span wire:loading.remove wire:target="uploadLpj">Upload & Setujui
                                                        LPJ</span>
                                                    <span wire:loading wire:target="uploadLpj">Mengupload...</span>
                                                </button>
                                            </form>
                                        </template>

                                        {{-- Jika activity belum selesai (Belum Dimulai atau Berlangsung) --}}
                                        <template
                                            x-if="getStatus(selectedActivity.start_date, selectedActivity.end_date).text !== 'Selesai' && (!selectedActivity.lpj || selectedActivity.lpj.status !== 'Disetujui')">
                                            <div
                                                class="text-center text-gray-500 dark:text-gray-400 flex flex-col items-center justify-center">
                                                <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2"
                                                    :class="getStatus(selectedActivity.start_date, selectedActivity.end_date)
                                                        .text === 'Belum Dimulai' ?
                                                        'bg-gray-100 dark:bg-gray-800' :
                                                        'bg-blue-100 dark:bg-blue-900/30'">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        :class="getStatus(selectedActivity.start_date, selectedActivity
                                                                .end_date).text === 'Belum Dimulai' ?
                                                            'text-gray-500 dark:text-gray-400' :
                                                            'text-blue-600 dark:text-blue-400'">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium mb-1"
                                                    x-text="'Kegiatan ' + getStatus(selectedActivity.start_date, selectedActivity.end_date).text"></span>
                                                <span class="text-xs text-gray-400 dark:text-gray-500">Upload LPJ
                                                    tersedia setelah kegiatan selesai</span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto"
                        @click="open = false">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
