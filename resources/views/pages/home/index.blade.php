<x-layouts.app title="Home">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 md:p-6">
        <!-- Header with Logo, Institution Name, and User Controls -->
        @livewire('home.header')
        <!-- COMPONENT 1: Card Statistik -->
        @livewire('home.card-keuangan')
        <!-- COMPONENT 2: Tabel Kegiatan - Responsive Table -->
        @livewire('home.table-kegiatan')
        <!-- COMPONENT 3: Tabel Transaksi - Responsive Table -->
        @livewire('home.table-transaksi')
    </div>
</x-layouts.app>