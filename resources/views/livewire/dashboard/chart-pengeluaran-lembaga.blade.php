<div class="sm:w-full lg:w-[85%]" x-data="barChartComponent()" x-init="initChart()">
    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg pt-4 h-[420px] px-2 transition-colors duration-200">
        <div class="flex items-start justify-between mb-6 ml-5">
            <div>
                <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Pengeluaran Per Lembaga</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total pengeluaran organisasi mahasiswa tahun 2024</p>
            </div>
        </div>
        <div id="barChart"></div>
    </div>
</div>

<script>
function barChartComponent() {
    return {
        chart: null,
        isDark: false,
        seriesData: [{
            name: 'Total Pengeluaran',
            data: [8500000, 7200000, 6800000, 5900000, 5400000, 4800000, 4500000, 4200000, 3900000, 3500000, 3200000, 2800000]
        }],
        categories: [
            'BEM',
            'HIMA TI',
            'HIMA SI',
            'HIMA Elektro',
            'UKM Olahraga',
            'UKM Seni',
            'HIMA Mesin',
            'MPM',
            'UKM Rohani',
            'HIMA Sipil',
            'UKM PMI',
            'LDK'
        ],

        formatIDR(val) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0,
                minimumFractionDigits: 0
            }).format(val);
        },

        formatShortIDR(val) {
            if (val >= 1000000) {
                return 'Rp ' + (val / 1000000).toFixed(1) + 'Jt';
            }
            return 'Rp ' + (val / 1000).toFixed(0) + 'Rb';
        },

        initChart() {
            this.checkDarkMode();
            this.renderChart();

            // Listen perubahan dark mode
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

            // Listen custom event
            window.addEventListener('theme-changed', () => {
                this.checkDarkMode();
                this.updateChart();
            });

            // Listen sistem dark mode
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!('theme' in localStorage)) {
                    this.checkDarkMode();
                    this.updateChart();
                }
            });
        },

        checkDarkMode() {
            this.isDark = document.documentElement.classList.contains('dark');
        },

        buildOptions() {
            const textColor = this.isDark ? '#E5E7EB' : '#374151';
            const gridBorder = this.isDark ? '#374151' : '#E5E7EB';
            const barColors = this.isDark ? ['#3B82F6', '#60A5FA', '#93C5FD'] : ['#2563EB', '#3B82F6', '#60A5FA'];

            return {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: { show: false },
                    background: 'transparent',
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 600,
                        animateGradually: {
                            enabled: true,
                            delay: 80
                        }
                    }
                },
                series: this.seriesData,
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        borderRadius: 8,
                        borderRadiusApplication: 'end',
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: (val) => this.formatShortIDR(val),
                    offsetY: -25,
                    style: {
                        fontSize: '11px',
                        colors: [textColor],
                        fontWeight: 600
                    }
                },
                xaxis: {
                    categories: this.categories,
                    labels: {
                        style: {
                            colors: new Array(this.categories.length).fill(textColor),
                            fontSize: '11px',
                            fontWeight: 500
                        },
                        rotate: -45,
                        rotateAlways: true,
                        minHeight: 80
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        formatter: (val) => this.formatShortIDR(val),
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
                        lines: { show: false }
                    },
                    yaxis: {
                        lines: { show: true }
                    },
                    padding: {
                        top: 0,
                        right: 20,
                        bottom: 10,
                        left: 10
                    }
                },
                colors: [this.isDark ? '#3B82F6' : '#2563EB'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: this.isDark ? 'dark' : 'light',
                        type: 'vertical',
                        shadeIntensity: 0.4,
                        gradientToColors: [this.isDark ? '#1D4ED8' : '#1E40AF'],
                        inverseColors: false,
                        opacityFrom: 0.95,
                        opacityTo: 0.75,
                        stops: [0, 100]
                    }
                },
                legend: {
                    show: false
                },
                states: {
                    hover: {
                        filter: {
                            type: 'lighten',
                            value: 0.1
                        }
                    },
                    active: {
                        filter: {
                            type: 'darken',
                            value: 0.1
                        }
                    }
                }
            };
        },

        renderChart() {
            const chartEl = document.querySelector('#barChart');
            if (!chartEl) return;
            
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