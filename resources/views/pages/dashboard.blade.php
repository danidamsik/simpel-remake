<x-layouts.admin title="Dashboard">
    <div class="min-h-screen space-y-8">
        <!-- Component Stat Cards -->
        @livewire('dashboard.card')
        @livewire('dashboard.chart-pengeluaran-bulan')
        <!-- Component Table Ringkasan Saldo Lembaga -->
        @livewire('dashboard.table-saldo-lembaga')

        <!-- Component Kegiatan Sedang Berlangsung -->
        @livewire('dashboard.kegiatan-berlangsung')

        <!-- Component Daftar LPJ Terlambat -->
        @livewire('dashboard.daftar-lpj-terlambat')
    </div>
    
</x-layouts.admin>
