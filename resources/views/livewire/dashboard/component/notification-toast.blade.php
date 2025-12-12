<!-- Notification Toast -->
<div x-cloak x-show="notification.show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2" class="fixed top-4 right-4 z-[100] max-w-sm">
    <div class="flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg"
        :class="notification.type === 'success' ?
            'bg-green-500 text-white' :
            'bg-red-500 text-white'">
        <!-- Success Icon -->
        <svg x-show="notification.type === 'success'" class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <!-- Error Icon -->
        <svg x-show="notification.type === 'error'" class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span x-text="notification.message" class="text-sm font-medium"></span>
        <button @click="notification.show = false" class="ml-auto p-1 hover:bg-white/20 rounded transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
