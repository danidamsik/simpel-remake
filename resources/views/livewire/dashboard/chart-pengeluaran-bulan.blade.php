<div class="sm:w-full lg:w-[90%] mx-auto" x-data="chartComponent()" x-init="initChart()">
    <div
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg pt-4 px-2 transition-colors duration-200">
        <div class="flex items-start justify-between mb-6 ml-5">
            <div>
                <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Pengeluaran Per Bulan</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Laporan pengeluaran bulanan tahun 2024</p>
            </div>
        </div>
        <div id="chart"></div>
    </div>
</div>

<script>
    function chartComponent() {
        return {
            chart: null,
            isDark: false,
            seriesData: @json($seriesData ?? []),
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],

            formatIDR(val) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(val);
            },

            // Format untuk sumbu Y (singkat) - tanpa .0
            formatYAxis(val) {
                if (val >= 1000000000) {
                    const formatted = (val / 1000000000);
                    return 'Rp ' + (formatted % 1 === 0 ? formatted.toFixed(0) : formatted.toFixed(1)) + ' M';
                } else if (val >= 1000000) {
                    const formatted = (val / 1000000);
                    return 'Rp ' + (formatted % 1 === 0 ? formatted.toFixed(0) : formatted.toFixed(1)) + ' Jt';
                } else if (val >= 1000) {
                    const formatted = (val / 1000);
                    return 'Rp ' + (formatted % 1 === 0 ? formatted.toFixed(0) : formatted.toFixed(1)) + ' Rb';
                } else if (val >= 100) {
                    return 'Rp ' + val.toFixed(0);
                }
                return 'Rp ' + val;
            },

            initChart() {
                this.checkDarkMode();
                this.renderChart();

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (!('theme' in localStorage)) {
                        this.checkDarkMode();
                        this.updateChart();
                    }
                });

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

                return {
                    chart: {
                        type: 'line',
                        height: 350,
                        toolbar: {
                            show: false
                        },
                        background: 'transparent',
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 400
                        }
                    },
                    series: [{
                        name: 'Pengeluaran',
                        data: this.seriesData
                    }],
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    markers: {
                        size: 5,
                        strokeWidth: 2,
                        strokeColors: this.isDark ? '#111827' : '#ffffff',
                        hover: {
                            size: 7
                        }
                    },
                    xaxis: {
                        categories: this.categories,
                        labels: {
                            style: {
                                colors: new Array(this.categories.length).fill(textColor),
                                fontSize: '12px'
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
                        tickAmount: 5, // Menambah jumlah label di sumbu Y
                        labels: {
                            formatter: (val) => this.formatYAxis(val),
                            style: {
                                colors: [textColor],
                                fontSize: '12px'
                            }
                        }
                    },
                    tooltip: {
                        theme: this.isDark ? 'dark' : 'light',
                        y: {
                            formatter: (val) => this.formatIDR(val)
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
                                show: false
                            }
                        }
                    },
                    colors: this.isDark ? ['#38BDF8'] : ['#0ea5e9'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: this.isDark ? 'dark' : 'light',
                            type: 'vertical',
                            shadeIntensity: 0.5,
                            gradientToColors: this.isDark ? ['#0284c7'] : ['#0369a1'],
                            inverseColors: false,
                            opacityFrom: 0.8,
                            opacityTo: 0.2,
                            stops: [0, 100]
                        }
                    },
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    }
                };
            },

            renderChart() {
                const chartEl = document.querySelector('#chart');
                const opts = this.buildOptions();
                this.chart = new ApexCharts(chartEl, opts);
                this.chart.render();
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
