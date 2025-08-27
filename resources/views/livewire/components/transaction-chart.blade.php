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


                    <div class="flex gap-1 p-1 bg-white/5 rounded-lg border border-white/10">
                        <button wire:click="setChartType('area')"
                            class="h-8 px-3 rounded transition-all duration-200 {{ $chartType === 'area' ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-white/10' }}"
                            type="button">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </button>
                        <button wire:click="setChartType('bar')"
                            class="h-8 px-3 rounded transition-all duration-200 {{ $chartType === 'bar' ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-white/10' }}"
                            type="button">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </button>
                        {{-- <button wire:click="setChartType('pie')"
                            class="h-8 px-3 rounded transition-all duration-200 {{ $chartType === 'pie' ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-white/10' }}"
                            type="button">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                        </button> --}}
                    </div>
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
            let chart;
            const income_data = @json($income_data);
            const expense_data = @json($expense_data);
            const date_time = @json($date_time);
            let currentChartType = @json($chartType); 

            function createChartOptions(income_data, expense_data, date_time, type = 'area') {
                // Default options
                const options = {
                    series: [{
                        name: 'Penghasilan',
                        data: income_data,
                    }, {
                        name: 'Pengeluaran',
                        data: expense_data,
                    }],
                    chart: {
                        height: 350,
                        type: type, // 🔥 Gunakan parameter type
                        background: 'transparent',
                        fontFamily: 'Inter, ui-sans-serif, system-ui',
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            if (val === 0) return '';
                            return new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            }).format(val);
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: type === 'bar' ? 0 : 2 
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '50%'
                        }
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
                            format: 'dd MMM yyyy'
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
                    colors: ['#10b981', '#ef4444'],
                };
                return options;
            }

            document.addEventListener('DOMContentLoaded', function() {
                chart = new ApexCharts(document.querySelector("#chart"), createChartOptions(income_data, expense_data,
                    date_time, currentChartType));
                chart.render();
            });

            document.addEventListener('livewire:initialized', () => {
                Livewire.on('updateChart', (data) => {
                    const newType = data[0].chartType || 'area';
                    const newIncome = data[0].income_data || [];
                    const newExpense = data[0].expense_data || [];

                    chart.updateOptions({
                        chart: {
                            type: newType
                        },
                        stroke: {
                            width: newType === 'bar' ? 0 : 2
                        },
                        xaxis: {
                            categories: data[0].date_time
                        }
                    });

                    chart.updateSeries([{
                        name: 'Penghasilan',
                        data: newIncome
                    }, {
                        name: 'Pengeluaran',
                        data: newExpense
                    }]);
                });
            });
        </script>
    @endpush


</div>
