<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
    <!-- Sisa Dana -->
    <div
        class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group">
        <div
            class="absolute right-0 top-0 opacity-10 transform translate-x-2 -translate-y-2 group-hover:scale-110 transition-transform">
            <i class="fas fa-wallet text-8xl"></i>
        </div>
        <div class="relative z-10">
            <p class="text-emerald-100 font-medium text-sm">Sisa Dana</p>
            <h3 class="text-2xl font-bold mt-1">Rp{{ number_format($sisaDana, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Dana Terpakai -->
    <div
        class="bg-gradient-to-br from-rose-500 to-pink-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group">
        <div
            class="absolute right-0 top-0 opacity-10 transform translate-x-2 -translate-y-2 group-hover:scale-110 transition-transform">
            <i class="fas fa-money-bill-wave text-8xl"></i>
        </div>
        <div class="relative z-10">
            <p class="text-rose-100 font-medium text-sm">Dana Terpakai</p>
            <h3 class="text-xl font-bold mt-1">Rp{{ number_format($danaTerpakai, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- LPJ Tersetor -->
    <div
        class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group">
        <div
            class="absolute right-0 top-0 opacity-10 transform translate-x-2 -translate-y-2 group-hover:scale-110 transition-transform">
            <i class="fas fa-file-invoice-dollar text-8xl"></i>
        </div>
        <div class="relative z-10">
            <p class="text-blue-100 font-medium text-sm">LPJ Tersetor</p>
            <h3 class="text-3xl font-bold mt-1">{{ $lpjTersetor }}</h3>
        </div>
    </div>

    <!-- Menunggu LPJ -->
    <div
        class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group">
        <div
            class="absolute right-0 top-0 opacity-10 transform translate-x-2 -translate-y-2 group-hover:scale-110 transition-transform">
            <i class="fas fa-clock text-8xl"></i>
        </div>
        <div class="relative z-10">
            <p class="text-amber-100 font-medium text-sm">Menunggu LPJ</p>
            <h3 class="text-3xl font-bold mt-1">{{ $menungguLpj }}</h3>
        </div>
    </div>

    <!-- Total Kegiatan -->
    <div
        class="bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow relative overflow-hidden group">
        <div
            class="absolute right-0 top-0 opacity-10 transform translate-x-2 -translate-y-2 group-hover:scale-110 transition-transform">
            <i class="fas fa-calendar-alt text-8xl"></i>
        </div>
        <div class="relative z-10">
            <p class="text-violet-100 font-medium text-sm">Total Kegiatan</p>
            <h3 class="text-3xl font-bold mt-1">{{ $totalKegiatan }}</h3>
        </div>
    </div>
</div>
