<div>
    <div
        class="p5 px-2 border-0 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-lg shadow-2xl glass rounded-lg mb-8">
        <div class="space-y-4 p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="text-xl font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Transaction Analytics
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            AI-powered financial insights and trends
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <!-- Time Range Selector -->
                    <select
                        class="w-32 border border-white/20 bg-white/5 backdrop-blur-sm rounded-lg px-3 py-2 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="chart" class="h-96 w-full" wire:ignore></div>

        <div class="p-6 pt-0">
            <div
                class="mt-6 p-4 bg-gradient-to-r from-blue-500/10 to-purple-500/10 border border-blue-500/20 rounded-lg">
                <div class="flex items-start gap-3">
                    <div class="p-2 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 mt-0.5">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium text-xl text-blue-400 mb-2">AI Insights</h4>
                        <p class="text-md text-gray-600 dark:text-gray-400 mb-3">
                            Your spending pattern shows a
                            {{ $stats['netChange'] === 'positive' ? 'healthy' : 'concerning' }} trend.
                            @if ($stats['netChange'] === 'positive')
                                You're saving more than spending - great job maintaining financial discipline!
                            @else
                                Consider reviewing your expenses to improve your financial balance.
                            @endif
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium text-white {{ $stats['netChange'] === 'positive' ? 'bg-gradient-to-r from-green-500 to-emerald-500' : 'bg-gradient-to-r from-orange-500 to-red-500' }}">
                                {{ $stats['netChange'] === 'positive' ? 'Excellent Progress' : 'Needs Attention' }}
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium text-white bg-gradient-to-r from-blue-500 to-purple-500">
                                Daily View
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>

        const income_data = @json($income_data);
        const expense_data = @json($expense_data);
        const date_time = @json($date_time);

        function updateChart (income_data, expense_data, date_time) {
            return  {
                    series: [{
                        name: 'Penghasilan',
                        data: income_data,
                    }, {
                        name: 'Pengeluaran',
                        data: expense_data,
                    }],
                    chart: {
                        height: 350,
                        type: 'area',
                        background: 'transparent',
                        fontFamily: 'Inter, ui-sans-serif, system-ui',
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: true, // 🔥 Aktifkan dataLabels
                        formatter: function(val) {
                            // Format angka ke IDR, hanya tampilkan jika > 0
                            if (val === 0) return ''; // Sembunyikan jika 0
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            }).format(val);
                        },
                        // Geser ke atas sedikit agar tidak menempel ke titik
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: date_time
                    },
                    yaxis: {
                        title: {
                            text: 'Amount (IDR)'
                        }
                    },
                    grid: {
                        borderColor: 'rgba(148, 163, 184, 0.2)',
                        strokeDashArray: 3
                    },
                    tooltip: {
                        x: {
                            format: 'dd MMM yyyy '
                        },
                        y: {
                            formatter: function(value) {
                                return new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }).format(value);
                            }
                        }
                    },
                    colors: ['#10b981', '#ef4444'], // hijau untuk income, merah untuk expense
                };
            
        }

        const chart = new ApexCharts(document.querySelector("#chart"), updateChart(income_data, expense_data, date_time));
        chart.render();

        Livewire.on('chartUpdate', (data) => {
            chart.updateSeries([{
                name: 'Penghasilan',
                data: data[0].income_data,
            }, {
                name: 'Pengeluaran',
                data: data[0].expense_data,
            }
        
        ])
        })
    </script>
@endpush


</div>
