<x-layouts.admin title="Master Data">
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen" x-data="{
        activeTab: new URLSearchParams(window.location.search).get('tab') || 'user',
        init() {
            // Watch for activeTab changes and update URL query parameter
            this.$watch('activeTab', (value) => {
                const url = new URL(window.location);
                url.searchParams.set('tab', value);
                window.history.pushState({}, '', url);
            });
        }
    }" x-init="init()">
        <!-- Component 1: Tabs -->
        <div class="bg-white dark:bg-gray-800 dark:border-gray-700 rounded-xl shadow-sm border border-gray-200 mb-6">
            @livewire('master-data.active-tab')
            <!-- Content Area -->
            <div class="p-4 md:p-6 text-gray-900 dark:text-gray-100">
                <!-- Tab Content: Data User -->
                @livewire('master-data.tab-content-user')
                <!-- Tab Content: Data Lembaga -->
                @livewire('master-data.tab-content-lembaga')
                <!-- Tab Content: Data Periode -->
                @livewire('master-data.tab-content-periode')
            </div>
        </div>
    </div>


    <style>
        /* Custom scrollbar for tabs */
        nav::-webkit-scrollbar {
            height: 4px;
        }

        nav::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        nav::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }

        nav::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }

        /* Hover effects */
        tr {
            transition: background-color 0.2s ease;
        }

        button:not(:disabled) {
            transition: all 0.2s ease;
        }

        /* Active tab styling */
        button[class*="border-b-2"] {
            position: relative;
        }

        button[class*="border-b-2"]::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        button.border-blue-600::after {
            transform: scaleX(1);
        }
    </style>
</x-layouts.admin>
