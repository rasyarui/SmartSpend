@php
    $summary = $this->savingsRate;
@endphp
<div>

    <div class="flex h-screen">
        @livewire('components.modal-transactions')


        <x-sidebar></x-sidebar>


        <main class="min-h-screen w-full lg:ml-72">
            
            <livewire:components.navbar />

            <div class="px-5 py-5 space-y-6 pb-10">
                {{-- Summary --}}
                <section class="px-5 space-y-10 max-w-8xl mx-auto w-full flex flex-col">
                    {{-- Header --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex flex-col gap-3">
                            <h1 class="text-3xl font-extrabold gradient-text bg-clip-text text-transparent">
                                Transaction Management</h1>
                            <p class="text-[15px] text-gray-500 dark:text-gray-400 ">
                                Track and manage all your financial transactions</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="button" wire:click="openModalIncome"
                                class="bg-gradient-to-br gap-3 w-full text-center justify-center from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-theme-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group relative cursor-pointer  text-white font-semibold px-5 py-2 rounded-lg flex items-center">
                                <div
                                    class="p-2 rounded-xl bg-white/20 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-5 w-5">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-md font-bold">Add Income</h3>
                                    <p class="text-green-100 text-xs text-nowrap">Record your earnings</p>
                                </div>
                            </button>
                            <button type="button" wire:click="openModalExpense"
                                class="bg-gradient-to-br gap-3 w-full text-center justify-center from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 shadow-theme-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group relative cursor-pointer  text-white font-semibold px-5 py-2 rounded-lg flex items-center">
                                <div
                                    class="p-2 rounded-xl bg-white/20 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-5 w-5">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-md font-bold">Add Expense</h3>
                                    <p class="text-green-100 text-xs">Track your spending</p>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        {{-- Income Card --}}
                        <div class="card flex glass flex-col space-y-3 p-6 rounded-xl hover-lift">
                            <div class="flex justify-between flex-row items-center">
                                <div
                                    class="p-2 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-up-icon lucide-trending-up h-8 w-8">
                                        <path d="M16 7h6v6" />
                                        <path d="m22 7-8.5 8.5-5-5L2 17" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-green-500 bg-green-500/10 px-2 py-1 rounded-full">
                                    Total Income
                                </span>
                            </div>
                            <h3 class="text-sm font-medium text-[#475569]">Income</h3>
                            <p class="text-2xl font-bold text-green-500">
                                Rp {{ number_format($this->stats['total_income'], 0, ',', '.') }}
                            </p>
                            <div class="{{ $this->incomeStats['color'] }} text-sm mt-1 flex items-center gap-1">
                                @if ($this->incomeStats['trend'] === 'up')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-up-icon lucide-trending-up h-5 w-5 ">
                                        <path d="M16 7h6v6" />
                                        <path d="m22 7-8.5 8.5-5-5L2 17" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-5 w-5 ">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                @endif
                                <strong>{{ abs($this->incomeStats['change']) }}%</strong>
                                {{ $this->incomeStats['label'] }} dari bulan lalu
                            </div>
                        </div>
                        {{-- Expense Card --}}
                        <div class="card flex glass flex-col space-y-3 p-6 rounded-xl hover-lift">
                            <div class="flex justify-between flex-row items-center">
                                <div
                                    class="p-2 rounded-xl bg-gradient-to-br from-red-500 to-pink-600 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-8 w-8">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-red-500 bg-red-500/10 px-2 py-1 rounded-full">
                                    Total Expense
                                </span>
                            </div>
                            <h3 class="text-sm font-medium text-[#475569]">Expense</h3>
                            <p class="text-2xl font-bold text-red-500">
                                Rp {{ number_format($this->stats['total_expense'], 0, ',', '.') }}
                            </p>
                            <div class="{{ $this->expenseStats['color'] }} text-sm mt-1 flex items-center gap-1">
                                @if ($this->expenseStats['trend'] === 'up')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-up-icon lucide-trending-up h-5 w-5 ">
                                        <path d="M16 7h6v6" />
                                        <path d="m22 7-8.5 8.5-5-5L2 17" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-5 w-5 ">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                @endif
                                <strong>{{ abs($this->expenseStats['change']) }}%</strong>
                                {{ $this->expenseStats['label'] }} dari bulan lalu
                            </div>
                        </div>
                        {{-- Balance Card --}}
                        <div class="card flex glass flex-col space-y-3 p-6 rounded-xl hover-lift">
                            <div class="flex justify-between flex-row items-center">
                                <div
                                    class="p-2 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-receipt-icon lucide-receipt h-8 w-8">
                                        <path
                                            d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                                        <path d="M12 17.5v-11" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-blue-500 bg-blue-500/10 px-2 py-1 rounded-full">
                                    Net Balance
                                </span>
                            </div>
                            <h3 class="text-sm font-medium text-[#475569]">Net Balance</h3>
                            <p class="text-2xl font-bold text-blue-500">
                                Rp {{ number_format($this->stats['balance'], 0, ',', '.') }}
                            </p>
                            <div class="{{ $this->balanceStats['color'] }} text-sm mt-1 flex items-center gap-1">
                                @if ($this->balanceStats['trend'] === 'up')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-up-icon lucide-trending-up h-5 w-5 ">
                                        <path d="M16 7h6v6" />
                                        <path d="m22 7-8.5 8.5-5-5L2 17" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-5 w-5 ">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                @endif
                                <strong>{{ abs($this->balanceStats['change']) }}%</strong>
                                {{ $this->balanceStats['label'] }} dari bulan lalu
                            </div>
                        </div>
                        {{-- Total Transaction Card --}}
                        <div class="card flex glass flex-col space-y-3 p-6 rounded-xl hover-lift">
                            <div class="flex justify-between flex-row items-center">
                                <div
                                    class="p-2 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-file-text-icon lucide-file-text h-8 w-8">
                                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                        <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                        <path d="M10 9H8" />
                                        <path d="M16 13H8" />
                                        <path d="M16 17H8" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-purple-500 bg-pink-500/10 px-2 py-1 rounded-full">
                                    Total Transactions
                                </span>
                            </div>
                            <h3 class="text-sm font-medium text-[#475569]">Total Transactions</h3>
                            <p class="text-2xl font-bold text-pink-500">
                                {{ $jumlahData }} Transactions
                            </p>
                        </div>
                    </div>
                </section>


                {{-- Table --}}
                <section>
                    <livewire:components.table />
                </section>

                {{-- AI Insight --}}
                <section class="px-6">
                    @if ($jumlahData == 0)
                        <div class="glass rounded-lg p-6">
                            <p class="flex justify-center text-gray-500">
                                Buat transaksi agar bisa membuka fitur AI Insight!
                            </p>
                        </div>
                    @else
                        <div class="glass rounded-lg p-6">
                            <div class="flex items-start gap-4">
                                <div class="p-3 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-sparkles-icon lucide-sparkles h-6 w-6">
                                        <path
                                            d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                                        <path d="M20 2v4" />
                                        <path d="M22 4h-4" />
                                        <circle cx="4" cy="20" r="2" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold mb-2">AI Transaction Insights</h3>
                                    <div class="space-y-3">
                                        <div
                                            class="p-4 {{ $this->ratioStatus['bg'] }} border border-green-500/20 rounded-lg">
                                            <p
                                                class="text-sm text-{{ $this->ratioStatus['color'] }}-600 dark:text-{{ $this->ratioStatus['color'] }}-400 font-medium mb-1 capitalize">
                                                {{ $this->ratioStatus['icon'] }}
                                                {{ $this->ratioStatus['type'] }}</p>
                                            <p class="text-sm text-muted-foreground">
                                                Pengeluaran anda
                                                <strong>{{ number_format($this->presentase) }}%</strong>
                                                dari penghasilan anda saat ini.
                                                <span
                                                    class="text-{{ $this->ratioStatus['color'] }}-600 dark:text-{{ $this->ratioStatus['color'] }}-400">
                                                    {{ $this->ratioStatus['message'] }}
                                                </span>
                                            </p>
                                        </div>

                                        <div
                                            class="p-4 bg-gradient-to-r from-blue-500/10 to-purple-500/10 border border-blue-500/20 rounded-lg">
                                            <p class="text-sm text-blue-600 dark:text-blue-400 font-medium mb-1">📊
                                                Spending Analysis</p>
                                            <p class="text-sm ">
                                                Rata-rata kamu mendapatkan
                                                <strong>Rp
                                                    {{ number_format($summary['daily_income'], 0, ',', '.') }}/hari</strong>
                                                dan menghabiskan
                                                <strong>Rp
                                                    {{ number_format($summary['daily_expense'], 0, ',', '.') }}/hari</strong>.
                                            </p>

                                        </div>

                                        <div
                                            class="p-4 bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-500/20 rounded-lg">
                                            <p class="text-sm text-purple-600 dark:text-purple-400 font-medium mb-1">
                                                🎯
                                                Recommendation</p>
                                            <p class="text-sm text-muted-foreground">
                                                Anda dapat menghemat tambahan 15% dengan mengoptimalkan biaya hiburan
                                                dan belanja.
                                            </p>
                                        </div>
                                        <div
                                            class="p-4 bg-gradient-to-r from-cyan-500/10 to-sky-500/10  border border-emerald-500/20 rounded-lg">
                                            <p class="text-sm text-cyan-600 dark:text-cyan-400 flex gap-1.5 text-center items-center font-medium mb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trending-up-icon lucide-trending-up h-4 w-4 text-green-500">
                                                    <path d="M16 7h6v6" />
                                                    <path d="m22 7-8.5 8.5-5-5L2 17" />
                                                </svg>
                                                Top Income Category
                                            </p>
                                            <p class="text-sm ">
                                                Kamu mendapatkan penghasilan terbanyak dari kategori
                                                <strong>
                                                    {{ $this->topCategory['top_category'] }}.
                                                </strong>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </section>

                <x-footer></x-footer>

            </div>



        </main>
    </div>
</div>
