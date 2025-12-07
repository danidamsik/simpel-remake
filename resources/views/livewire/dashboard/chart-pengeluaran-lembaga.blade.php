<div class="sm:w-full lg:w-[100%]" x-data="horizontalBarChartComponent()" x-init="initChart()">
    <div
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg pt-4 transition-colors duration-200">
        <div class="flex items-start justify-between ml-5">
            <div>
                <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Pengeluaran Per Lembaga</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Distribusi pengeluaran berdasarkan lembaga tahun 2024</p>
            </div>
        </div>
        <div id="horizontal-bar-chart"></div>
    </div>
</div>

<script>
    function horizontalBarChartComponent() {
        return {
            chart: null,
            isDark: false,
            
            // DATA 50 LEMBAGA UIN - URUTAN DARI TERBESAR KE TERKECIL
            seriesData: [
                850000000,  // Fakultas Syariah dan Hukum
                820000000,  // Fakultas Ushuluddin dan Filsafat
                795000000,  // Fakultas Dakwah dan Komunikasi
                780000000,  // Fakultas Adab dan Humaniora
                765000000,  // Fakultas Tarbiyah dan Keguruan
                745000000,  // Fakultas Ekonomi dan Bisnis Islam
                720000000,  // Fakultas Sains dan Teknologi
                695000000,  // Fakultas Ilmu Sosial dan Ilmu Politik
                670000000,  // Fakultas Psikologi
                645000000,  // Pascasarjana S2 Pendidikan Islam
                620000000,  // Pascasarjana S2 Ekonomi Syariah
                595000000,  // Pascasarjana S3 Studi Islam
                570000000,  // Pusat Studi Gender dan Anak
                545000000,  // Lembaga Penelitian dan Pengabdian Masyarakat
                520000000,  // Pusat Bahasa dan Budaya
                495000000,  // Ma'had Al-Jami'ah (Pesantren Kampus)
                470000000,  // Lembaga Penjaminan Mutu
                445000000,  // Perpustakaan Pusat
                420000000,  // UPT Teknologi Informasi dan Pangkalan Data
                395000000,  // Pusat Studi Al-Qur'an
                370000000,  // Lembaga Pengembangan Akademik
                345000000,  // Pusat Kajian Timur Tengah
                320000000,  // Biro Administrasi Umum Perencanaan
                295000000,  // Biro Administrasi Akademik
                270000000,  // Biro Administrasi Kemahasiswaan
                245000000,  // Unit Layanan Terpadu
                220000000,  // Pusat Pengembangan Karir dan Kewirausahaan
                195000000,  // Lembaga Bimbingan Konseling dan Pemberdayaan
                170000000,  // Pusat Studi Hukum Islam
                155000000,  // Laboratorium Komputer
                140000000,  // Laboratorium Bahasa
                125000000,  // Radio Kampus UIN
                110000000,  // Koperasi Mahasiswa
                98000000,   // Unit Kegiatan Mahasiswa Olahraga
                87000000,   // UKM Seni dan Budaya
                76000000,   // UKM Jurnalistik
                68000000,   // Lembaga Dakwah Kampus
                60000000,   // UKM Keilmuan dan Penalaran
                54000000,   // Asrama Mahasiswa Putra
                48000000,   // Asrama Mahasiswa Putri
                43000000,   // Poliklinik Kampus
                38000000,   // Masjid Kampus
                34000000,   // Kantin dan Kafeteria
                30000000,   // UKM Pecinta Alam
                26000000,   // Bank Mini Kampus
                23000000,   // UKM Pramuka
                20000000,   // UKM Paduan Suara
                17000000,   // Lapangan Olahraga
                14000000,   // Taman Bacaan
                10000000,   // Pos Satpam
            ],
            
            // KATEGORI 50 LEMBAGA UIN
            categories: [
                'Fakultas Syariah dan Hukum',
                'Fakultas Ushuluddin dan Filsafat',
                'Fakultas Dakwah dan Komunikasi',
                'Fakultas Adab dan Humaniora',
                'Fakultas Tarbiyah dan Keguruan',
                'Fakultas Ekonomi dan Bisnis Islam',
                'Fakultas Sains dan Teknologi',
                'Fakultas Ilmu Sosial dan Ilmu Politik',
                'Fakultas Psikologi',
                'Pascasarjana S2 Pendidikan Islam',
                'Pascasarjana S2 Ekonomi Syariah',
                'Pascasarjana S3 Studi Islam',
                'Pusat Studi Gender dan Anak',
                'Lembaga Penelitian dan Pengabdian Masyarakat',
                'Pusat Bahasa dan Budaya',
                'Ma\'had Al-Jami\'ah',
                'Lembaga Penjaminan Mutu',
                'Perpustakaan Pusat',
                'UPT TI dan Pangkalan Data',
                'Pusat Studi Al-Qur\'an',
                'Lembaga Pengembangan Akademik',
                'Pusat Kajian Timur Tengah',
                'Biro Adm. Umum Perencanaan',
                'Biro Adm. Akademik',
                'Biro Adm. Kemahasiswaan',
                'Unit Layanan Terpadu',
                'Pusat Pengembangan Karir',
                'Lembaga Bimbingan Konseling',
                'Pusat Studi Hukum Islam',
                'Laboratorium Komputer',
                'Laboratorium Bahasa',
                'Radio Kampus UIN',
                'Koperasi Mahasiswa',
                'UKM Olahraga',
                'UKM Seni dan Budaya',
                'UKM Jurnalistik',
                'Lembaga Dakwah Kampus',
                'UKM Keilmuan',
                'Asrama Mahasiswa Putra',
                'Asrama Mahasiswa Putri',
                'Poliklinik Kampus',
                'Masjid Kampus',
                'Kantin dan Kafeteria',
                'UKM Pecinta Alam',
                'Bank Mini Kampus',
                'UKM Pramuka',
                'UKM Paduan Suara',
                'Lapangan Olahraga',
                'Taman Bacaan',
                'Pos Satpam',
            ],

            formatIDR(val) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(val);
            },

            formatShortIDR(val) {
                if (val >= 1000000000) {
                    return 'Rp' + (val / 1000000000).toFixed(1) + 'M';
                }
                return 'Rp' + (val / 1000000).toFixed(0) + 'Jt';
            },

            initChart() {
                this.checkDarkMode();
                this.renderChart();

                // Listen perubahan sistem
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (!('theme' in localStorage)) {
                        this.checkDarkMode();
                        this.updateChart();
                    }
                });

                // Listen perubahan class dark di HTML
                const observer = new MutationObserver(() => {
                    const newDarkState = document.documentElement.classList.contains('dark');
                    if (this.isDark !== newDarkState) {
                        this.isDark = newDarkState;
                        this.updateChart();
                    }
                });

                observer.observe(document.documentElement, {
                    attributes: true,
                    attributeFilter: ['class']
                });
            },

            checkDarkMode() {
                this.isDark = document.documentElement.classList.contains('dark');
            },

            buildOptions() {
                const textColor = this.isDark ? '#E5E7EB' : '#374151';
                const gridBorder = this.isDark ? '#374151' : '#E5E7EB';
                
                // Warna untuk chart bars - gradient untuk horizontal
                const colors = [this.isDark ? '#3B82F6' : '#0EA5E9'];

                return {
                    chart: {
                        type: 'bar',
                        height: 1400, // Tinggi ditambah untuk 50 lembaga
                        toolbar: {
                            show: false
                        },
                        background: 'transparent',
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 600
                        }
                    },
                    series: [{
                        name: 'Total Pengeluaran',
                        data: this.seriesData
                    }],
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            borderRadiusApplication: 'end',
                            horizontal: true,
                            barHeight: '70%',
                            distributed: true,
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (val) => {
                            return this.formatShortIDR(val);
                        },
                        textAnchor: 'start',
                        offsetX: 10,
                        style: {
                            fontSize: '11px',
                            fontWeight: 'bold',
                            colors: [this.isDark ? '#E5E7EB' : '#1F2937']
                        }
                    },
                    stroke: {
                        show: true,
                        width: 1,
                        colors: [this.isDark ? '#1F2937' : '#FFFFFF']
                    },
                    xaxis: {
                        categories: this.categories,
                        position: 'bottom',
                        labels: {
                            show: true,
                            style: {
                                colors: textColor,
                                fontSize: '12px',
                                fontWeight: 500
                            },
                            formatter: (val) => {
                                return this.formatShortIDR(val);
                            }
                        },
                        axisBorder: {
                            show: true,
                            color: gridBorder,
                            height: 1
                        },
                        axisTicks: {
                            show: true,
                            color: gridBorder
                        }
                    },
                    yaxis: {
                        labels: {
                            show: true,
                            style: {
                                colors: new Array(this.categories.length).fill(textColor),
                                fontSize: '12px',
                                fontWeight: 500
                            },
                            maxWidth: 200,
                            align: 'left'
                        },
                        reversed: false
                    },
                    tooltip: {
                        theme: this.isDark ? 'dark' : 'light',
                        y: {
                            formatter: (val) => this.formatIDR(val),
                            title: {
                                formatter: () => 'Pengeluaran: '
                            }
                        },
                        x: {
                            formatter: (val, { seriesIndex, dataPointIndex, w }) => {
                                return this.categories[dataPointIndex];
                            }
                        },
                        style: {
                            fontSize: '13px'
                        }
                    },
                    grid: {
                        borderColor: gridBorder,
                        strokeDashArray: 4,
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
                    colors: colors,
                    fill: {
                        opacity: 0.9,
                        type: 'solid'
                    },
                    legend: {
                        show: false
                    },
                    responsive: [{
                        breakpoint: 768,
                        options: {
                            chart: {
                                height: 1600
                            },
                            plotOptions: {
                                bar: {
                                    borderRadius: 6,
                                    barHeight: '60%'
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontSize: '10px'
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        fontSize: '11px'
                                    },
                                    maxWidth: 150
                                }
                            }
                        }
                    }]
                };
            },

            renderChart() {
                const chartEl = document.querySelector('#horizontal-bar-chart');
                if (chartEl) {
                    const opts = this.buildOptions();
                    this.chart = new ApexCharts(chartEl, opts);
                    this.chart.render();
                }
            },

            updateChart() {
                if (this.chart) {
                    this.chart.destroy();
                    this.renderChart();
                }
            }
        }
    }
</script>