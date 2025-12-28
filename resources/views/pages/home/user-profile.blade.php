<x-layouts.app>
    <x-slot name="title">User Profile</x-slot>

    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold text-slate-800 dark:text-slate-200 mb-6">
            User Settings
        </h2>
        @livewire('home.user-profile')
    </div>
</x-layouts.app>
