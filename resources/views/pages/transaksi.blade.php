<x-layouts.admin title="Transaksi">
    <div class="p-4 md:p-6 space-y-6">
        <!-- Summary Cards -->
        @livewire('transaksi.card')
        
        <!-- Filters & Table -->
        @livewire('transaksi.filter-table')
    </div>
</x-layouts.admin>
