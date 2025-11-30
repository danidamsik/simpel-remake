<<<<<<< HEAD
<x-layouts.app title="Dashboard">
    <div x-data="dashboard()"
        class="min-h-screen p-0">
        <!-- Component Stat Cards -->
        @livewire('dashboard.card')

        <!-- Component Line Chart Pengeluaran Perbulan -->
        @livewire('dashboard.chart-pengeluaran-bulan')

        <!-- Component Bar Chart Pengeluaran Per Lembaga -->
        @livewire('dashboard.chart-pengeluaran-lembaga')

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
                // Data dummy untuk semua komponen
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

                init() {
                    // Inisialisasi Line Chart (Component 2)
                    this.initLineChart();

                    // Inisialisasi Bar Chart (Component 3)
                    this.initBarChart();
                },

                initLineChart() {
                    // Data pengeluaran dalam Rupiah (dalam ribuan)
                    const pengeluaranData = [
                        45000, 52000, 38000, 65000, 72000,
                        58000, 63000, 75000, 68000, 80000,
                        72000, 85000
                    ];

                    const options = {
                        series: [{
                            name: 'Pengeluaran',
                            data: pengeluaranData
                        }],
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: true,
                                tools: {
                                    download: true,
                                    selection: true,
                                    zoom: true,
                                    zoomin: true,
                                    zoomout: true,
                                    pan: true,
                                    reset: true
                                }
                            }
                        },
                        colors: ['#3b82f6'],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'],
                                opacity: 0.5
                            },
                        },
                        markers: {
                            size: 5,
                            colors: ['#3b82f6'],
                            strokeColors: '#fff',
                            strokeWidth: 2,
                            hover: {
                                size: 7
                            }
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                            ],
                            title: {
                                text: 'Bulan'
                            },
                            axisBorder: {
                                show: true,
                                color: '#e7e7e7'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Rupiah'
                            },
                            min: 0,
                            max: 100000,
                            labels: {
                                formatter: function(value) {
                                    // Format angka dengan titik sebagai pemisah ribuan
                                    return 'Rp ' + value.toString().replace(
                                        /\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function(value) {
                                    return 'Rp ' + value.toString().replace(
                                        /\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                            }
                        }
                    };

                    const chart = new ApexCharts(document.querySelector("#lineChart"), options);
                    chart.render();
                },

                initBarChart() {
                    // Data pengeluaran per lembaga dalam Rupiah (dalam juta)
                    const pengeluaranLembaga = [{
                            x: 'BEM Universitas',
                            y: 45.5 // 45.5 juta
                        },
                        {
                            x: 'HIMA Teknik',
                            y: 32.3 // 32.3 juta
                        },
                        {
                            x: 'UKM Olahraga',
                            y: 28.7 // 28.7 juta
                        },
                        {
                            x: 'BEM Ekonomi',
                            y: 52.1 // 52.1 juta
                        },
                        {
                            x: 'HIMA Manajemen',
                            y: 38.9 // 38.9 juta
                        },
                        {
                            x: 'UKM Seni',
                            y: 25.4 // 25.4 juta
                        },
                        {
                            x: 'BEM Hukum',
                            y: 35.6 // 35.6 juta
                        }
                    ];

                    const options = {
                        series: [{
                            name: 'Pengeluaran',
                            data: pengeluaranLembaga
                        }],
                        chart: {
                            type: 'bar',
                            height: 400,
                            toolbar: {
                                show: true,
                                tools: {
                                    download: true,
                                    selection: true,
                                    zoom: false,
                                    zoomin: false,
                                    zoomout: false,
                                    pan: false,
                                    reset: false
                                }
                            }
                        },
                        colors: ['#10b981'],
                        plotOptions: {
                            bar: {
                                borderRadius: 6,
                                horizontal: true,
                                distributed: false,
                                barHeight: '70%',
                                dataLabels: {
                                    position: 'top'
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function(val) {
                                return 'Rp ' + val.toFixed(1) + ' Jt';
                            },
                            offsetX: 30,
                            style: {
                                fontSize: '11px',
                                fontWeight: 600,
                                colors: ['#059669']
                            }
                        },
                        stroke: {
                            width: 1,
                            colors: ['#fff']
                        },
                        grid: {
                            borderColor: '#e5e7eb',
                            strokeDashArray: 3,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: false
                                }
                            }
                        },
                        xaxis: {
                            labels: {
                                formatter: function(val) {
                                    return 'Rp ' + val.toFixed(1) + ' Jt';
                                },
                                style: {
                                    fontSize: '11px',
                                    colors: '#6b7280'
                                }
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 500,
                                    colors: '#374151'
                                },
                                maxWidth: 180
                            }
                        },
                        tooltip: {
                            theme: 'light',
                            y: {
                                formatter: function(val) {
                                    return 'Rp ' + val.toFixed(1) + ' Juta';
                                }
                            },
                            style: {
                                fontSize: '12px'
                            }
                        },
                        legend: {
                            show: false
                        }
                    };

                    const chart = new ApexCharts(document.querySelector("#barChart"), options);
                    chart.render();
                }
            }));
        });
    </script>
</x-layouts.app>
=======
<x-layouts.admin title="Dashboard">
    <p>ini halaman dashboard</p>
</x-layouts.admin>
>>>>>>> origin/main
