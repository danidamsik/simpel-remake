<x-layouts.admin title="Pengajuan Kegiatan">
    <div x-data="{
        notification: {
            show: false,
            type: '',
            message: ''
        },
        init() {
            @if (session('success')) this.showNotification('success', '{{ session('success') }}'); @endif
            @if (session('error')) this.showNotification('error', '{{ session('error') }}'); @endif
        },
        showNotification(type, message) {
            this.notification = { show: true, type: type, message: message };
            setTimeout(() => this.notification.show = false, 4000);
        }
    }" class="relative">

        {{-- Notification Toast --}}
        <template x-if="notification.show">
            <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                class="fixed top-20 right-4 z-50 max-w-sm">
                <div :class="{
                    'bg-green-500': notification.type === 'success',
                    'bg-red-500': notification.type === 'error',
                    'bg-blue-500': notification.type === 'info'
                }"
                    class="text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-3">

                    <template x-if="notification.type === 'success'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </template>
                    <template x-if="notification.type === 'error'">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>

                    <span x-text="notification.message" class="text-sm"></span>
                    <button @click="notification.show = false" class="ml-auto text-white/80 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </template>

        <div class="space-y-6">
            <!-- Statistics Cards Component -->
            @livewire('pengajuan-kegiatan.card-statistik')

            <!-- Filter and Table Combined Component -->
            @livewire('pengajuan-kegiatan.filter-table-proposal')
        </div>
    </div>
</x-layouts.admin>
