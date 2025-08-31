<div>
    <div class="fixed inset-0 bg-black/50 z-2 hidden lg:hidden" id="overlay" onclick="closeSidebar()">
        </div>

        <nav id="sidebar2"
            class="fixed  h-full w-72 glass border-r border-border z-3  transform -translate-x-full lg:translate-x-0  transition-transform duration-300 ease-in-out">
            <!-- Header -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    <div
                        class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-theme hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-brain-cog-icon lucide-brain-cog h-7 w-7 text-white">
                            <path d="m10.852 14.772-.383.923" />
                            <path d="m10.852 9.228-.383-.923" />
                            <path d="m13.148 14.772.382.924" />
                            <path d="m13.531 8.305-.383.923" />
                            <path d="m14.772 10.852.923-.383" />
                            <path d="m14.772 13.148.923.383" />
                            <path
                                d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 0 0-5.63-1.446 3 3 0 0 0-.368 1.571 4 4 0 0 0-2.525 5.771" />
                            <path d="M17.998 5.125a4 4 0 0 1 2.525 5.771" />
                            <path d="M19.505 10.294a4 4 0 0 1-1.5 7.706" />
                            <path
                                d="M4.032 17.483A4 4 0 0 0 11.464 20c.18-.311.892-.311 1.072 0a4 4 0 0 0 7.432-2.516" />
                            <path d="M4.5 10.291A4 4 0 0 0 6 18" />
                            <path d="M6.002 5.125a3 3 0 0 0 .4 1.375" />
                            <path d="m9.228 10.852-.923-.383" />
                            <path d="m9.228 13.148-.923.383" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold gradient-text">SmartSpend</h1>
                        <p class="text-xs text-muted-foreground flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-sparkles-icon lucide-sparkles">
                                <path
                                    d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                                <path d="M20 2v4" />
                                <path d="M22 4h-4" />
                                <circle cx="4" cy="20" r="2" />
                            </svg>
                            Finance Tracking Modern
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation Items -->
            <div class="p-4 space-y-2" wire:ignore>
                <a href="/dashboard"
                    class="nav-item {{ request()->is('dashboard') ? 'active' : ''}} flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
                    data-page="dashboard">
                    <div class="p-2 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-house-icon lucide-house h-4 w-4 text-white">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="/transaksi"
                    class="nav-item {{ request()->is('transaksi') ? 'active' : ''}} flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
                    data-page="transaksis">
                    <div class="p-2 rounded-lg bg-gradient-to-br from-green-500 to-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-credit-card-icon lucide-credit-card h-4 w-4 text-white">
                            <rect width="20" height="14" x="2" y="5" rx="2" />
                            <line x1="2" x2="22" y1="10" y2="10" />
                        </svg>
                    </div>
                    <span class="font-medium">Transaksi</span>
                </a>

                <a href="/tabunganku"
                    class="nav-item {{ request()->is('tabunganku') ? 'active' : ''}} flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
                    data-page="savings">
                    <div class="p-2 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-piggy-bank-icon lucide-piggy-bank h-4 w-4 text-">
                            <path
                                d="M11 17h3v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-3a3.16 3.16 0 0 0 2-2h1a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-1a5 5 0 0 0-2-4V3a4 4 0 0 0-3.2 1.6l-.3.4H11a6 6 0 0 0-6 6v1a5 5 0 0 0 2 4v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1z" />
                            <path d="M16 10h.01" />
                            <path d="M2 8v1a2 2 0 0 0 2 2h1" />
                        </svg>
                    </div>
                    <span class="font-medium">Tabunganku</span>
                </a>

                <a href=""
                    class="nav-item {{ request()->is('dashboard') ? 'kelola' : ''}} flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
                    data-page="settings">
                    <div class="p-2 rounded-lg bg-gradient-to-br from-yellow-500 to-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-settings-icon lucide-settings h-4 w-4 text-white">
                            <path
                                d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                    <span class="font-medium">Kelola</span>
                </a>
            </div>

            <!-- Theme Status Indicator -->
            <div class="absolute bottom-20 left-4 right-4 mb-5" wire:ignore>
                <div class="p-3 rounded-lg glass border border-border transition-all duration-300">
                    <div class="flex items-center gap-2 text-xs">
                        <div id="theme-indicator" class="w-2 h-2 rounded-full animate-pulse bg-yellow-400"></div>

                        <span class="text-muted-foreground" id="theme-label"></span>


                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="absolute bottom-4 left-4 right-4">
                <div class="p-4 glass border border-border rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <div>
                            <p class="text-sm font-medium">AI Assistant</p>
                            <p class="text-xs text-muted-foreground">Online & Ready</p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
</div>