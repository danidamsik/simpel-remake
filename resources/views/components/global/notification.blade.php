<div x-data="{
    show: false,
    message: '',
    type: 'success', // success, error, info, warning
    init() {
        // Check for session flash messages on page load
        @if (session('success')) this.message = '{{ session('success') }}';
            this.type = 'success';
            this.show = true;
            setTimeout(() => { this.show = false }, 5000);
        @elseif(session('error'))
            this.message = '{{ session('error') }}';
            this.type = 'error';
            this.show = true;
            setTimeout(() => { this.show = false }, 5000);
        @elseif(session('info'))
            this.message = '{{ session('info') }}';
            this.type = 'info';
            this.show = true;
            setTimeout(() => { this.show = false }, 5000);
        @elseif(session('warning'))
            this.message = '{{ session('warning') }}';
            this.type = 'warning';
            this.show = true;
            setTimeout(() => { this.show = false }, 5000); @endif
    }
}"
    x-on:notify.window="
        if ($event.detail.message) {
            message = $event.detail.message;
            type = $event.detail.type || 'success';
            show = true;
            setTimeout(() => { show = false }, 5000);
        } else if (Array.isArray($event.detail) && $event.detail[0]) {
            message = $event.detail[0].message || $event.detail[0];
            type = $event.detail[0].type || 'success';
            show = true;
            setTimeout(() => { show = false }, 5000);
        }
    "
    x-show="show" x-cloak x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="-translate-y-2 opacity-0 sm:-translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-0 right-0 m-6 w-full max-w-sm overflow-hidden rounded-xl shadow-2xl z-[9999] pointer-events-none"
    style="display: none;">

    <div class="pointer-events-auto w-full overflow-hidden rounded-xl shadow-lg ring-1 ring-black ring-opacity-5"
        :class="{
            'bg-white shadow-gray-200/50': true,
            'dark:bg-green-600 dark:ring-green-500': type === 'success',
            'dark:bg-red-600 dark:ring-red-500': type === 'error',
            'dark:bg-blue-600 dark:ring-blue-500': type === 'info',
            'dark:bg-yellow-600 dark:ring-yellow-500': type === 'warning',
            'dark:bg-gray-800 dark:ring-gray-700': !['success', 'error', 'info', 'warning'].includes(type)
        }">
        <div class="p-4">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <!-- Success Icon -->
                    <template x-if="type === 'success'">
                        <svg class="h-6 w-6 text-green-500 dark:text-white" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                    <!-- Error Icon -->
                    <template x-if="type === 'error'">
                        <svg class="h-6 w-6 text-red-500 dark:text-white" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>
                    </template>
                    <!-- Info Icon -->
                    <template x-if="type === 'info'">
                        <svg class="h-6 w-6 text-blue-500 dark:text-white" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12v-.008z" />
                        </svg>
                    </template>
                    <!-- Warning Icon -->
                    <template x-if="type === 'warning'">
                        <svg class="h-6 w-6 text-yellow-500 dark:text-white" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.008v.008H12v-.008z" />
                        </svg>
                    </template>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-900 dark:text-white leading-5"
                        x-text="type.charAt(0).toUpperCase() + type.slice(1)"></p>
                    <p class="mt-0.5 text-sm text-gray-600 dark:text-white/90 leading-5" x-text="message"></p>
                </div>

                <div class="flex-shrink-0 flex self-start">
                    <button type="button" @click="show = false"
                        class="inline-flex rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 dark:text-white/70 dark:hover:bg-black/10 dark:hover:text-white transition-all focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
