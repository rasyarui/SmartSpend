<div>
    <header class="glass border-b border-border shadow-theme transition-all duration-300 ">
        <div class="container mx-auto px-1 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4 lg:hidden">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-theme">
                        <i data-lucide="brain-circuit" class="h-8 w-8 text-white"></i>
                    </div>
                    <h1 class="text-3xl font-bold gradient-text">FinanceAI</h1>
                </div>


                <div class="hidden lg:block">
                    <h1 class="text-4xl font-bold gradient-text" id="page-title">Dashboard</h1>
                    <p class="text-md text-muted-foreground flex items-center gap-2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-sparkles-icon lucide-sparkles">
                            <path
                                d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                            <path d="M20 2v4" />
                            <path d="M22 4h-4" />
                            <circle cx="4" cy="20" r="2" />
                        </svg>
                        Intelligent Web3 Financial Management
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <!-- AI Status -->
                    <div class="hidden sm:flex items-center gap-2 px-4 py-2 rounded-full glass border border-border">
                        <div class="relative">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <div class="absolute inset-0 w-2 h-2 bg-green-400 rounded-full animate-ping opacity-30">
                            </div>
                        </div>
                        <span class="text-xs font-medium text-green-500">AI Active</span>
                    </div>

                    <!-- Theme Toggle -->
                    <div class="relative">
                        <button id="mode-menu-button"
                            class="flex items-center gap-1 px-3 py-2 rounded-full glass border border-border text-xs transition-all cursor-pointer duration-300 hover:scale-105">
                            <div
                                class="inline-flex justify-center px-1 py-1 text-sm font-medium cursor-pointer rounded-lg  transition-colors duration-1100">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="icon-light"
                                    width="18px">
                                    <path
                                        d="M19 9.199h-.98c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799H19c.552 0 1-.357 1-.799 0-.441-.449-.801-1-.801zM10 4.5A5.483 5.483 0 0 0 4.5 10c0 3.051 2.449 5.5 5.5 5.5 3.05 0 5.5-2.449 5.5-5.5S13.049 4.5 10 4.5zm0 9.5c-2.211 0-4-1.791-4-4 0-2.211 1.789-4 4-4a4 4 0 0 1 0 8zm-7-4c0-.441-.449-.801-1-.801H1c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799h1c.551 0 1-.358 1-.799zm7-7c.441 0 .799-.447.799-1V1c0-.553-.358-1-.799-1-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1zm0 14c-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1 .441 0 .799-.447.799-1v-1c0-.553-.358-1-.799-1zm7.365-13.234c.391-.391.454-.961.142-1.273s-.883-.248-1.272.143l-.7.699c-.391.391-.454.961-.142 1.273s.883.248 1.273-.143l.699-.699zM3.334 15.533l-.7.701c-.391.391-.454.959-.142 1.271s.883.25 1.272-.141l.7-.699c.391-.391.454-.961.142-1.274s-.883-.247-1.272.142zm.431-12.898c-.39-.391-.961-.455-1.273-.143s-.248.883.141 1.274l.7.699c.391.391.96.455 1.272.143s.249-.883-.141-1.273l-.699-.7zm11.769 14.031l.7.699c.391.391.96.453 1.272.143.312-.312.249-.883-.142-1.273l-.699-.699c-.391-.391-.961-.455-1.274-.143s-.248.882.143 1.273z">
                                    </path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="icon-dark"
                                    width="18px" class="fill-amber-50">
                                    <path
                                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z">
                                    </path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" viewBox="0 0 32 32"
                                    id="icon-system">
                                    <path
                                        d="M30 2H2a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2h9.998c-.004 1.446-.062 3.324-.61 4h-.404A.992.992 0 0 0 10 29c0 .552.44 1 .984 1h10.03A.992.992 0 0 0 22 29c0-.552-.44-1-.984-1h-.404c-.55-.676-.606-2.554-.61-4H30a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM14 24l-.002.004L14 24zm4.002.004L18 24h.002v.004zM30 20H2V4h28v16z">
                                    </path>
                                </svg>
                            </div>
                            <span id="theme-label" class="font-medium w-full">Light Mode</span>
                        </button>

                        <!-- Theme Dropdown -->
                        @teleport('body')
                            <div id="mode-menu" 
                                class="absolute right-32 top-22 mt-2 w-48 glass border border-border rounded-lg shadow-theme-lg hidden z-[99]">
                                <div class="p-2">
                                    <div class="text-xs font-medium text-muted-foreground mb-2 px-2">Choose Theme
                                    </div>

                                    <button
                                        class="theme-option w-full flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#94A3B81A] transition-all duration-200 cursor-pointer"
                                        role="menuitem" id="mode-light" data-mode-option="light">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="light"
                                            width="18px" class="mr-2 dark:fill-amber-50">
                                            <path
                                                d="M19 9.199h-.98c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799H19c.552 0 1-.357 1-.799 0-.441-.449-.801-1-.801zM10 4.5A5.483 5.483 0 0 0 4.5 10c0 3.051 2.449 5.5 5.5 5.5 3.05 0 5.5-2.449 5.5-5.5S13.049 4.5 10 4.5zm0 9.5c-2.211 0-4-1.791-4-4 0-2.211 1.789-4 4-4a4 4 0 0 1 0 8zm-7-4c0-.441-.449-.801-1-.801H1c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799h1c.551 0 1-.358 1-.799zm7-7c.441 0 .799-.447.799-1V1c0-.553-.358-1-.799-1-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1zm0 14c-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1 .441 0 .799-.447.799-1v-1c0-.553-.358-1-.799-1zm7.365-13.234c.391-.391.454-.961.142-1.273s-.883-.248-1.272.143l-.7.699c-.391.391-.454.961-.142 1.273s.883.248 1.273-.143l.699-.699zM3.334 15.533l-.7.701c-.391.391-.454.959-.142 1.271s.883.25 1.272-.141l.7-.699c.391-.391.454-.961.142-1.274s-.883-.247-1.272.142zm.431-12.898c-.39-.391-.961-.455-1.273-.143s-.248.883.141 1.274l.7.699c.391.391.96.455 1.272.143s.249-.883-.141-1.273l-.699-.7zm11.769 14.031l.7.699c.391.391.96.453 1.272.143.312-.312.249-.883-.142-1.273l-.699-.699c-.391-.391-.961-.455-1.274-.143s-.248.882.143 1.273z">
                                            </path>
                                        </svg>
                                        <div class="flex-1 text-left">
                                            <span class="font-medium text-sm">Light Mode</span>
                                            <p class="text-xs text-muted-foreground">Bright and clean interface</p>
                                        </div>
                                    </button>

                                    <button
                                        class="theme-option w-full flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#94A3B81A] transition-all duration-200 cursor-pointer"
                                        role="menuitem" id="mode-dark" data-mode-option="dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="moon"
                                            width="18px" class="mr-2 dark:fill-amber-50">
                                            <path
                                                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z">
                                            </path>
                                        </svg>
                                        <div class="flex-1 text-left">
                                            <span class="font-medium text-sm">Dark Mode</span>
                                            <p class="text-xs text-muted-foreground">Easy on your eyes</p>
                                        </div>
                                    </button>

                                    <button
                                        class="theme-option w-full flex items-center gap-3 px-3 py-2 rounded-md hover:bg-[#94A3B81A] transition-all duration-200 cursor-pointer"
                                        role="menuitem" id="mode-system" data-mode-option="system">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px"
                                            class="mr-2 dark:fill-amber-50" viewBox="0 0 32 32" id="desktop">
                                            <path
                                                d="M30 2H2a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2h9.998c-.004 1.446-.062 3.324-.61 4h-.404A.992.992 0 0 0 10 29c0 .552.44 1 .984 1h10.03A.992.992 0 0 0 22 29c0-.552-.44-1-.984-1h-.404c-.55-.676-.606-2.554-.61-4H30a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM14 24l-.002.004L14 24zm4.002.004L18 24h.002v.004zM30 20H2V4h28v16z">
                                            </path>
                                        </svg>
                                        <div class="flex-1 text-left">
                                            <span class="font-medium text-sm">System</span>
                                            <p class="text-xs text-muted-foreground">Match your device settings</p>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endteleport

                    </div>


                    <!-- Account Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open"
                            class="flex items-center px-3 py-3 rounded-full glass border border-border text-xs transition-all cursor-pointer duration-300 hover:scale-105">
                            Account
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90"
                            class="absolute right-0 top-full mt-2 w-33 glass border border-border rounded-lg shadow-theme-lg ">
                            <button class="p-2 cursor-pointer" wire:click="logout">
                                <span class="text-xs font-medium text-muted-foreground mb-2 px-2">Logout
                                </span>
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </header>


</div>
