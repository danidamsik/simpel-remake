<x-layouts.admin title="Dashboard">
    <div x-data="dashboard()" class="min-h-screen space-y-8">
        <!-- Component Stat Cards -->
        @livewire('dashboard.card')

        @livewire('dashboard.chart-pengeluaran-lembaga')
        @livewire('dashboard.chart-pengeluaran-bulan')
        <!-- Component Table Ringkasan Saldo Lembaga -->
        @livewire('dashboard.table-saldo-lembaga')

        <!-- Component Kegiatan Sedang Berlangsung -->
        @livewire('dashboard.kegiatan-berlangsung')

        <!-- Component Daftar LPJ Terlambat -->
        @livewire('dashboard.daftar-lpj-terlambat')
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dashboard', () => ({
                kegiatanBerlangsung: [{
                        id: 1,
                        nama: "Pekan Ilmiah Mahasiswa 2024",
                        lembaga: "BEM Fakultas Teknik",
                        tanggal: "15 Mar - 20 Mar 2024",
                        penanggungJawab: "Ahmad Rizki Maulana",
                        status: "Berlangsung",
                        hariTersisa: "3 hari lagi"
                    },
                    {
                        id: 2,
                        nama: "Pelatihan Kepemimpinan",
                        lembaga: "HIMA Teknik Informatika",
                        tanggal: "18 Mar - 22 Mar 2024",
                        penanggungJawab: "Siti Aminah Putri",
                        status: "Aktif",
                        hariTersisa: "5 hari lagi"
                    },
                    {
                        id: 3,
                        nama: "Seminar Kewirausahaan Digital",
                        lembaga: "UKM Kewirausahaan",
                        tanggal: "20 Mar - 21 Mar 2024",
                        penanggungJawab: "Budi Santoso",
                        status: "Berlangsung",
                        hariTersisa: "2 hari lagi"
                    },
                    {
                        id: 4,
                        nama: "Workshop UI/UX Design",
                        lembaga: "HIMA Desain Komunikasi Visual",
                        tanggal: "19 Mar - 23 Mar 2024",
                        penanggungJawab: "Dian Pertiwi",
                        status: "Aktif",
                        hariTersisa: "4 hari lagi"
                    },
                    {
                        id: 5,
                        nama: "Turnamen E-Sport Antar Fakultas",
                        lembaga: "UKM E-Sport",
                        tanggal: "16 Mar - 25 Mar 2024",
                        penanggungJawab: "Eko Prasetyo",
                        status: "Berlangsung",
                        hariTersisa: "6 hari lagi"
                    },
                    {
                        id: 6,
                        nama: "Bakti Sosial Desa Binaan",
                        lembaga: "BEM Universitas",
                        tanggal: "22 Mar - 24 Mar 2024",
                        penanggungJawab: "Rina Wulandari",
                        status: "Aktif",
                        hariTersisa: "5 hari lagi"
                    }
                ],
                ringkasanLembaga: [{
                        id: 1,
                        nama: "BEM Universitas",
                        totalDana: "Rp 250.000.000",
                        danaTerpakai: "Rp 85.500.000",
                        danaSekarang: "Rp 164.500.000",
                        statusLPJ: "Lengkap"
                    },
                    {
                        id: 2,
                        nama: "HIMA Teknik",
                        totalDana: "Rp 180.000.000",
                        danaTerpakai: "Rp 92.300.000",
                        danaSekarang: "Rp 87.700.000",
                        statusLPJ: "Belum Lengkap"
                    },
                    {
                        id: 3,
                        nama: "UKM Olahraga",
                        totalDana: "Rp 120.000.000",
                        danaTerpakai: "Rp 45.200.000",
                        danaSekarang: "Rp 74.800.000",
                        statusLPJ: "Lengkap"
                    },
                    {
                        id: 4,
                        nama: "BEM Fakultas Ekonomi",
                        totalDana: "Rp 95.000.000",
                        danaTerpakai: "Rp 67.800.000",
                        danaSekarang: "Rp 27.200.000",
                        statusLPJ: "Belum Lengkap"
                    }
                ],

                lpjTerlambat: [{
                        id: 1,
                        namaKegiatan: "Workshop Digital Marketing",
                        namaLembaga: "HIMA Manajemen",
                        terlambatHari: 5
                    },
                    {
                        id: 2,
                        namaKegiatan: "Turnamen Futsal Antar Angkatan",
                        namaLembaga: "UKM Olahraga",
                        terlambatHari: 12
                    },
                    {
                        id: 3,
                        namaKegiatan: "Bakti Sosial Desa",
                        namaLembaga: "BEM Fakultas",
                        terlambatHari: 8
                    }
                ],
            }));
        });
    </script>
</x-layouts.admin>
