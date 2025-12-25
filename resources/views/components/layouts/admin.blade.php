<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => {
    localStorage.setItem('darkMode', val);
    document.documentElement.classList.toggle('dark', val);
});
// Apply dark mode on init
if (darkMode) {
    document.documentElement.classList.add('dark');
}"
    :class="{ 'dark': darkMode }">

<head>
    @include('components.admin.head')
    @livewireStyles
</head>

<body class="bg-gray-50 dark:bg-gray-900 font-sans antialiased transition-colors duration-300" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        @persist('sidebar')
            @include('components.admin.sidebar')
        @endpersist

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            @persist('header')
                @include('components.admin.header')
            @endpersist

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-8 transition-colors duration-300">
                {{ $slot }}
            </main>
        </div>
    </div>

    @persist('mobile-overlay')
        @include('components.admin.mobile-overlay')
    @endpersist

    @livewireScripts

    <!-- Ensure dark mode persists after wire:navigate -->
    <script>
        // Apply dark mode immediately
        (function() {
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        })();

        // Re-apply dark mode after Livewire navigation
        document.addEventListener('livewire:navigated', () => {
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    </script>
    @include('components.global.notification')
</body>

</html>
