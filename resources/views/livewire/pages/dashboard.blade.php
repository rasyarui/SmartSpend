<div>
    <div class="flex h-screen">

        {{-- Modal --}}
        @livewire('components.modal-transactions')

        {{-- End Modal --}}

        {{-- Btn Menu Mobile --}}
        <div class="fixed top-4 left-4 z-1 lg:hidden">
            <button id="sidebar-open-btn" onclick="openSidebar()"
                class="p-2 rounded-lg glass border border-border hover:bg-card transition-all duration-300 shadow-theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-align-justify-icon lucide-align-justify h-5 w-5">
                    <path d="M3 12h18" />
                    <path d="M3 18h18" />
                    <path d="M3 6h18" />
                </svg>
            </button>
        </div>

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <main class="min-h-screen w-full lg:ml-72">

            <!-- Header -->
            <livewire:components.navbar />

            {{-- Content Main --}}
            <div class="px-5 pb-10">
                <section class="px-5 py-6  max-w-8xl mx-auto w-full flex flex-col items-center">
                    <div
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full glass border transition-all duration-300 hover:scale-105 hover:shadow-theme mb-4">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-zap-icon lucide-zap h-4 w-4 text-yellow-500 animate-pulse">
                                <path
                                    d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />
                            </svg>
                        </div>
                        <span
                            class="font-medium bg-gradient-to-r from-yellow-600 to-orange-500 bg-clip-text text-transparent">
                            Welcome back, {{ auth()->user()->name }}
                        </span>
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"> </div>
                    </div>

                    <div class="relative w-full text-center items-center flex flex-col gap-4">
                        <div
                            class="text-5xl md:text-6xl font-extrabold text-center text-balance  gradient-text leading-tight">
                            <span>
                                Your Financial Future,
                            </span>
                            <br>
                            <span>
                                Intelligently Managed
                            </span>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 mb-6 md:text-xl max-w-3xl ext-center">Lacak
                            keuanganmu dengan mudah sekarang yang didukung AI dan integrasi teknologi modern, yang
                            beradaptasi dengan gaya hidup Anda!
                            Kelola pemasukan
                            &
                            pengeluaran tanpa stres. Yuk, mulai lebih rapi hari ini!</p>
                        <div class=" flex-wrap w-full grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <button type="button" wire:click="openModalIncome"
                                class="bg-gradient-to-br h-24 gap-5 text-center justify-center from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 shadow-theme-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group relative cursor-pointer  text-white font-semibold px-5 py-2 rounded-lg flex items-center">
                                <div
                                    class="p-3 rounded-xl bg-white/20 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-8 w-8">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-xl font-bold mb-1">Add Income</h3>
                                    <p class="text-green-100 text-sm">Record your earnings</p>
                                </div>
                            </button>
                            <button type="button" wire:click="openModalExpense"
                                class="bg-gradient-to-br h-24 gap-5 text-center justify-center from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 shadow-theme-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group relative cursor-pointer  text-white font-semibold px-5 py-2 rounded-lg flex items-center">
                                <div
                                    class="p-3 rounded-xl bg-white/20 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trending-down-icon lucide-trending-down h-8 w-8">
                                        <path d="M16 17h6v-6" />
                                        <path d="m22 17-8.5-8.5-5 5L2 7" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-xl font-bold mb-1">Add Expense</h3>
                                    <p class="text-green-100 text-sm">Track your spending</p>
                                </div>
                            </button>

                        </div>
                    </div>
                </section>

                <!-- Quote Card -->
                <section class="quote-card-container px-5 relative group">
                    <div
                        class="relative p-4 glass border border-border rounded-2xl shadow-theme-lg hover:shadow-xl transition-all duration-500 hover:scale-[1.02] hover-lift overflow-hidden">
                        <!-- Top Icon Section -->
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="p-2 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 shadow-theme animate-float">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-lightbulb-icon lucide-lightbulb h-4 w-4">
                                        <path
                                            d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5" />
                                        <path d="M9 18h6" />
                                        <path d="M10 22h4" />
                                    </svg>
                                </div>
                                <div
                                    class="flex items-center gap-2 px-3 py-1.5 rounded-full glass border border-yellow-500/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-sparkles-icon lucide-sparkles h-3 w-3 text-yellow-500 animate-pulse">
                                        <path
                                            d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                                        <path d="M20 2v4" />
                                        <path d="M22 4h-4" />
                                        <circle cx="4" cy="20" r="2" />
                                    </svg>
                                    <span
                                        class="text-xs font-medium bg-gradient-to-r from-yellow-600 to-orange-500 bg-clip-text text-transparent">
                                        Wisdom
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Quote Content -->
                        <div class="relative">
                            <div class="flex items-start gap-2 mb-3">
                                <p
                                    class="text-[15px] max-w-[550px] md:text-md font-medium leading-relaxed bg-gradient-to-r from-foreground via-blue-600 to-purple-600 bg-clip-text text-transparent gradient-text">
                                    " Don't save the remaining money after spending, but spend the remaining money after
                                    saving."
                                </p>
                            </div>

                            <!-- Attribution -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-theme">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="lucide lucide-quote-icon lucide-quote h-6 w-6">
                                            <path
                                                d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z" />
                                            <path
                                                d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z" />
                                        </svg>
                                    </div>
                                    <div>

                                        <p class="text-md font-bold not-italic">Warren Buffett</p>
                                        <div class="text-sm text-gray-400 flex items-center gap-2">
                                            <span>Chairperson of Berkshire Hathawa</span>
                                            <div class="w-1 h-1 bg-green-400 rounded-full animate-pulse"></div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Summary section -->
                <section class="px-5 py-8 max-w-8xl mx-auto w-full flex flex-col gap-6">
                    <livewire:components.card-transaction />
                </section>

                {{-- Table --}}
                <section class="w-full ">
                    <livewire:components.table />
                </section>

                {{-- Chart --}}
                <section class="px-5">
                    <livewire:components.transaction-chart />
                </section>


                {{-- Footer --}}
                <x-footer></x-footer>

            </div>


        </main>
    </div>


</div>
