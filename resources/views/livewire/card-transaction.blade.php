<div>
    <div x-data="{
        // State variables untuk kontrol lokal (tidak sync dengan Livewire)
        showBalance: false,
        showIncome: false,
        showExpense: false,
    
    
        // Animated values
        animatedBalance: 0,
        animatedIncome: 0,
        animatedExpense: 0,
    
        // Actual values dari Livewire
        get actualBalance() {
            return @this.actualBalance || 0;
        },
        get actualIncome() {
            return @this.actualIncome || 0;
        },
        get actualExpense() {
            return @this.actualExpense || 0;
        },
    
        previousBalance: 0,
        previousIncome: 0,
        previousExpense: 0,
    
        // Flag untuk mencegah multiple animasi
        isAnimating: {
            balance: false,
            income: false,
            expense: false
        },
    
        init() {
            // Animasi saat page load dengan delay berurutan
            this.$nextTick(() => {
                setTimeout(() => {
                    this.showBalance = false;
                    this.animateNumber('balance', this.actualBalance);
                }, 300);
    
                setTimeout(() => {
                    this.showIncome = false;
                    this.animateNumber('income', this.actualIncome);
                }, 600);
    
                setTimeout(() => {
                    this.showExpense = false;
                    this.animateNumber('expense', this.actualExpense);
                }, 900);
            });
    
            this.watchForDataChanges();
        },
    
    
        watchForDataChanges() {
            // Set interval untuk check perubahan data
            setInterval(() => {
                // Check balance changes
                if (this.actualBalance !== this.previousBalance) {
                    this.previousBalance = this.actualBalance;
                    if (this.showBalance) {
                        this.animateNumber('balance', this.actualBalance);
                    }
                }
    
                // Check income changes
                if (this.actualIncome !== this.previousIncome) {
                    this.previousIncome = this.actualIncome;
                    if (this.showIncome) {
                        this.animateNumber('income', this.actualIncome);
                    }
                }
    
                // Check expense changes
                if (this.actualExpense !== this.previousExpense) {
                    this.previousExpense = this.actualExpense;
                    if (this.showExpense) {
                        this.animateNumber('expense', this.actualExpense);
                    }
                }
            }, 500); // Check every 500ms
        },
    
        animateNumber(type, targetValue) {
            if (this.isAnimating[type]) return;
    
            this.isAnimating[type] = true;
            const duration = 1200; // 1.2 detik
            const steps = 60;
            let step = 0;
    
            // Reset ke 0 setiap kali animasi dimulai
            if (type === 'balance') this.animatedBalance = 0;
            if (type === 'income') this.animatedIncome = 0;
            if (type === 'expense') this.animatedExpense = 0;
    
            const timer = setInterval(() => {
                step++;
                const progress = step / steps;
    
                // Easing function untuk animasi yang smooth
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const animatedValue = Math.floor(targetValue * easeOutQuart);
    
                if (type === 'balance') {
                    this.animatedBalance = animatedValue;
                } else if (type === 'income') {
                    this.animatedIncome = animatedValue;
                } else if (type === 'expense') {
                    this.animatedExpense = animatedValue;
                }
    
                if (step >= steps) {
                    clearInterval(timer);
                    // Set nilai final yang tepat
                    if (type === 'balance') this.animatedBalance = targetValue;
                    if (type === 'income') this.animatedIncome = targetValue;
                    if (type === 'expense') this.animatedExpense = targetValue;
    
                    this.isAnimating[type] = false;
                }
            }, duration / steps);
        },
    
        formatNumber(value) {
            return new Intl.NumberFormat('id-ID').format(value || 0);
        },
    
        // Function untuk handle toggle dengan animasi
        toggleCard(type) {
            if (type === 'balance') {
                if (this.showBalance) {
                    // Jika sedang ditampilkan, sembunyikan
                    this.showBalance = false;
                } else {
                    // Jika sedang disembunyikan, tampilkan dengan animasi
                    this.showBalance = true;
                    setTimeout(() => this.animateNumber('balance', this.actualBalance), 100);
                }
            } else if (type === 'income') {
                if (this.showIncome) {
                    this.showIncome = false;
                } else {
                    this.showIncome = true;
                    setTimeout(() => this.animateNumber('income', this.actualIncome), 100);
                }
            } else if (type === 'expense') {
                if (this.showExpense) {
                    this.showExpense = false;
                } else {
                    this.showExpense = true;
                    setTimeout(() => this.animateNumber('expense', this.actualExpense), 100);
                }
            }
        },
        showAllData() {
            // Tampilkan semua dengan delay berurutan seperti saat page load
            if (!this.showBalance) {
                this.showBalance = true;
                setTimeout(() => this.animateNumber('balance', this.actualBalance), 100);
            }
    
            setTimeout(() => {
                if (!this.showIncome) {
                    this.showIncome = true;
                    setTimeout(() => this.animateNumber('income', this.actualIncome), 100);
                }
            }, 200);
    
            setTimeout(() => {
                if (!this.showExpense) {
                    this.showExpense = true;
                    setTimeout(() => this.animateNumber('expense', this.actualExpense), 100);
                }
            }, 400);
        },
        hideAllData() {
            // Sembunyikan semua dengan delay berurutan
            this.showBalance = false;
    
            setTimeout(() => {
                this.showIncome = false;
            }, 100);
    
            setTimeout(() => {
                this.showExpense = false;
            }, 200);
        },
        hideAllData() {
            this.showBalance = false;
    
            setTimeout(() => {
                this.showIncome = false;
            }, 100);
    
            setTimeout(() => {
                this.showExpense = false;
            }, 200);
        },
    
        // Function baru untuk toggle
        toggleAllData() {
            if (this.isAllDataVisible) {
                this.hideAllData();
                this.isAllDataVisible = false;
            } else {
                this.showAllData();
                this.isAllDataVisible = true;
            }
        },
        toggleAllDataAuto() {
            // Cek apakah semua data sedang ditampilkan
            const allVisible = this.showBalance && this.showIncome && this.showExpense;
    
            if (allVisible) {
                this.hideAllData();
            } else {
                this.showAllData();
            }
        }
    }">

        <div class="flex items-center justify-between mb-[15px]">

            <div class="flex flex-col gap-2">
                <h3 class="text-3xl font-extrabold text-black dark:text-white transition-colors duration-1000">Ringkasan</h3>
                <button type="button" @click="toggleAllDataAuto()"
                    class="border border-gray-300 dark:border-gray-600 dark:text-[#fafafa] cursor-pointer text-black rounded px-3 py-1 dark:hover:bg-gray-700 hover:bg-gray-200 transition-colors duration-1000  whitespace-nowrap flex items-center gap-2">
                    <!-- Show Icon (Simple) -->
                    <svg x-show="!(showBalance && showIncome && showExpense)" class="w-4 h-4" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <!-- Hide Icon (Simple) -->
                    <svg x-show="(showBalance && showIncome && showExpense)" class="w-4 h-4" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                    </svg>

                    <p x-show="!(showBalance && showIncome && showExpense)">Tampilkan Semua Data</p>
                    <p x-show="(showBalance && showIncome && showExpense)">Sembunyikan Semua Data</p>
                </button>
            </div>

            <div class="flex items-center gap-3 flex-wrap relative" x-data="{ open: false }">
                <button type="button" @click="open = !open"
                    class="flex items-center gap-2 border border-gray-300 dark:border-gray-600 dark:text-[#fafafa] text-black rounded px-4 py-1 dark:hover:bg-gray-700 hover:bg-gray-200 transition-colors duration-1000 cursor-pointer whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <title>Filter icon</title>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
                    </svg>
                    <span x-text="`${$wire.startDate} - ${$wire.endDate}`"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95" x-cloak
                    class="absolute right-0 top-full mt-2 w-72 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-10 p-4">


                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 transition-colors duration-1000">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Custom
                            Range</label>
                        <div class="flex flex-col items-center space-x-2">
                            <input type="date" wire:model="startDate"
                                class="form-input rounded-md shadow-sm w-full dark:bg-gray-700 dark:text-white ">
                            <span>to</span>
                            <input type="date" wire:model="endDate"
                                class="form-input rounded-md shadow-sm w-full dark:bg-gray-700 dark:text-white">
                        </div>
                        <button @click="$wire.loadFinancialData(); open = false"
                            class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">Apply</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Wrapper dengan Alpine.js untuk animasi -->

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <article
                    class="dark:bg-gray-900 bg-white shadow-2xl rounded-lg p-5 flex items-center justify-between gap-4 card-hover transition-color duration-1000">
                    <div class="flex items-center gap-3">
                        <div
                            class="p-3 bg-purple-900 rounded-lg transform transition-transform duration-200 hover:scale-110">
                            <svg class="h-6 w-6 text-purple-300" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a4 4 0 00-8 0v2m-5 3h14l1 9H4l1-9z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Balance</p>
                            <div class="relative">
                                <p x-show="showBalance" class="dark:text-white text-xl font-bold animate-slide-up transition-all duration-1000"
                                    :class="{ 'number-glow': isAnimating.balance }">
                                    Rp <span x-text="formatNumber(animatedBalance)"
                                        :class="{ 'animate-pulse-gentle': isAnimating.balance }"
                                        class="text-purple-400"></span>
                                </p>
                                <p x-show="!showBalance" class="dark:text-white text-xl font-bold transition-all duration-1000">*******</p>
                            </div>
                        </div>
                    </div>

                    <button type="button" aria-label="Toggle visibility balance" @click="toggleCard('balance')"
                        class="text-gray-500 hover:text-purple-400 transition-color duration-1000 cursor-pointer transform hover:scale-110 hover:rotate-12 btn-animate">
                        <svg x-show="showBalance" x-transition:enter="transition ease-out duration-200 delay-100"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180" xmlns="http://www.w3.org/2000/svg"
                            class="text-purple-400" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="!showBalance" x-transition:enter="transition ease-out duration-200 delay-100"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="m4 4l16 16m-3.5-3.244C15.147 17.485 13.618 18 12 18c-3.53 0-6.634-2.452-8.413-4.221c-.47-.467-.705-.7-.854-1.159c-.107-.327-.107-.913 0-1.24c.15-.459.385-.693.855-1.16c.897-.892 2.13-1.956 3.584-2.793M19.5 14.634c.333-.293.638-.582.912-.854l.003-.003c.468-.466.703-.7.852-1.156c.107-.327.107-.914 0-1.241c-.15-.458-.384-.692-.854-1.159C18.633 8.452 15.531 6 12 6q-.507 0-1 .064m2.323 7.436a2 2 0 0 1-2.762-2.889" />
                        </svg>
                    </button>
                </article>

                <!-- Income Card -->
                <article
                    class="dark:bg-gray-900 bg-white shadow-2xl rounded-lg p-5 flex items-center justify-between gap-4 card-hover transition-color duration-1000">
                    <div class="flex items-center gap-3">
                        <div
                            class="p-3 bg-emerald-900 rounded-lg transform transition-transform duration-200 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <title>Income arrow icon</title>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 11l5-5m0 0l5 5m-5-5v12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Income</p>
                            <div class="relative">
                                <p x-show="showIncome" class="dark:text-white text-xl font-bold animate-slide-up transition-all duration-1000"
                                    :class="{ 'number-glow': isAnimating.income }">
                                    Rp <span x-text="formatNumber(animatedIncome)"
                                        :class="{ 'animate-pulse-gentle': isAnimating.income }"
                                        class="text-emerald-400"></span>
                                </p>
                                <p x-show="!showIncome" class="dark:text-white text-xl font-bold transition-all duration-1000">*******</p>
                            </div>
                        </div>
                    </div>

                    <button type="button" aria-label="Toggle visibility income" @click="toggleCard('income')"
                        class="text-gray-500 hover:text-emerald-400 transition-all duration-300 cursor-pointer transform hover:scale-110 hover:rotate-12 btn-animate">
                        <svg x-show="showIncome" x-transition:enter="transition ease-out duration-200 delay-100"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180" xmlns="http://www.w3.org/2000/svg"
                            class="text-emerald-400" width="24" height="24" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="!showIncome" x-transition:enter="transition ease-out duration-200 delay-100"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="m4 4l16 16m-3.5-3.244C15.147 17.485 13.618 18 12 18c-3.53 0-6.634-2.452-8.413-4.221c-.47-.467-.705-.7-.854-1.159c-.107-.327-.107-.913 0-1.24c.15-.459.385-.693.855-1.16c.897-.892 2.13-1.956 3.584-2.793M19.5 14.634c.333-.293.638-.582.912-.854l.003-.003c.468-.466.703-.7.852-1.156c.107-.327.107-.914 0-1.241c-.15-.458-.384-.692-.854-1.159C18.633 8.452 15.531 6 12 6q-.507 0-1 .064m2.323 7.436a2 2 0 0 1-2.762-2.889" />
                        </svg>
                    </button>
                </article>

                <!-- Expense Card -->
                <article
                    class="dark:bg-gray-900 bg-white shadow-2xl rounded-lg p-5 flex items-center justify-between gap-4 card-hover transition-all duration-1000">
                    <div class="flex items-center gap-3">
                        <div
                            class="p-3 bg-red-900 rounded-lg transform transition-transform duration-200 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <title>Expense down arrow icon</title>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Expense</p>
                            <div class="relative">
                                <p x-show="showExpense" class="dark:text-white text-xl font-bold animate-slide-up"
                                    :class="{ 'number-glow': isAnimating.expense }">
                                    Rp <span x-text="formatNumber(animatedExpense)"
                                        :class="{ 'animate-pulse-gentle': isAnimating.expense }"
                                        class="text-red-400"></span>
                                </p>
                                <p x-show="!showExpense" class="dark:text-white text-xl font-bold transition-all duration-1000">*******</p>
                            </div>
                        </div>
                    </div>

                    <button type="button" aria-label="Toggle visibility expense" @click="toggleCard('expense')"
                        class="text-gray-500 hover:text-red-400 transition-all duration-300 cursor-pointer transform hover:scale-110 hover:rotate-12 btn-animate">
                        <svg x-show="showExpense" x-transition:enter="transition ease-out duration-200 delay-100"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180" xmlns="http://www.w3.org/2000/svg"
                            class="text-red-400" width="24" height="24" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="!showExpense" x-transition:enter="transition ease-out duration-200 delay-100"
                            x-transition:enter-start="opacity-0 rotate-180"
                            x-transition:enter-end="opacity-100 rotate-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 rotate-0"
                            x-transition:leave-end="opacity-0 rotate-180" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="m4 4l16 16m-3.5-3.244C15.147 17.485 13.618 18 12 18c-3.53 0-6.634-2.452-8.413-4.221c-.47-.467-.705-.7-.854-1.159c-.107-.327-.107-.913 0-1.24c.15-.459.385-.693.855-1.16c.897-.892 2.13-1.956 3.584-2.793M19.5 14.634c.333-.293.638-.582.912-.854l.003-.003c.468-.466.703-.7.852-1.156c.107-.327.107-.914 0-1.241c-.15-.458-.384-.692-.854-1.159C18.633 8.452 15.531 6 12 6q-.507 0-1 .064m2.323 7.436a2 2 0 0 1-2.762-2.889" />
                        </svg>
                    </button>
                </article>
            </div>



    </div>
</div>
