<div>
    <div>
        <header class="flex items-center justify-between px-6 py-4 border-b border-gray-700">
            <button id="menu-btn" aria-label="Toggle sidebar" aria-expanded="false" aria-controls="sidebar"
                class="focus:outline-none focus:ring-2 focus:ring-green-500 p-2 rounded md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div>
                <p class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, d M Y') }}
                </p>
                <h1 class="text-2xl font-bold dark:text-white text-black flex items-center gap-2">Selamat pagi <span
                        aria-label="sun" role="img">🌞</span></h1>
            </div>
            <div class="flex items-center gap-4">
                <livewire:jam />

                {{-- <el-dropdown class="relative inline-block">
                    <div class="w-10 h-10 rounded-lg border p-[6px] border-gray-700 cursor-pointer justify-between">
                        <button id="mode-menu-button" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <defs>
                                    <mask id="lineMdLightDark0">
                                        <circle cx="7.5" cy="7.5" r="5.5" fill="#fff" />
                                        <circle cx="7.5" cy="7.5" r="5.5">
                                            <animate fill="freeze" attributeName="cx" dur="0.4s" values="7.5;11" />
                                            <animate fill="freeze" attributeName="r" dur="0.4s" values="5.5;6.5" />
                                        </circle>
                                    </mask>
                                    <mask id="lineMdLightDark1">
                                        <g fill="#fff">
                                            <circle cx="12" cy="9" r="5.5">
                                                <animate fill="freeze" attributeName="cy" begin="1s" dur="0.5s"
                                                    values="9;15" />
                                            </circle>
                                            <g fill-opacity="0">
                                                <use href="#lineMdLightDark2" transform="rotate(-75 12 15)" />
                                                <use href="#lineMdLightDark2" transform="rotate(-25 12 15)" />
                                                <use href="#lineMdLightDark2" transform="rotate(25 12 15)" />
                                                <use href="#lineMdLightDark2" transform="rotate(75 12 15)" />
                                                <set fill="freeze" attributeName="fill-opacity" begin="1.5s"
                                                    to="1" />
                                            </g>
                                        </g>
                                        <path d="M0 10h26v5h-26z" />
                                        <path class="dark:stroke-white" stroke="#000000" stroke-dasharray="26" stroke-dashoffset="26"
                                            stroke-width="2" d="M23 12h-22">
                                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s"
                                                dur="0.4s" values="26;0" />
                                        </path>
                                    </mask>
                                    <symbol id="lineMdLightDark2">
                                        <path d="M11 18h2L12 20z" opacity="0">
                                            <animate fill="freeze" attributeName="d" begin="1.5s" dur="0.4s"
                                                values="M11 18h2L12 20z;M10.5 21.5h3L12 24z" />
                                            <set fill="freeze" attributeName="opacity" begin="1.5s" to="1" />
                                        </path>
                                    </symbol>
                                </defs>
                                <g fill="#fff">
                                    <rect width="13" height="13" x="1" y="1" mask="url(#lineMdLightDark0)" />
                                    <path d="M-2 11h28v13h-28z" mask="url(#lineMdLightDark1)"
                                        transform="rotate(-45 12 12)" />
                                </g>
                            </svg>
                        </button>

                        <el-menu id="dropdownMenu" anchor="bottom end" popover aria-labelledby="mode-menu-button" id="mode-menu" role="menu"
                            class="m-[8px] origin-top-rig rounded-md dark:bg-white p-0 shadow-lg ring-1 ring-black/5 transition [--anchor-gap:theme(spacing.2)] [transition-behavior:allow-discrete] focus:outline-none data-[closed]:scale-95 data-[closed]:transform data-[closed]:opacity-0 data-[enter]:duration-100 data-[leave]:duration-75 data-[enter]:ease-out data-[leave]:ease-in">
                            <button class="rounded-b-[4px] p-4 hover:bg-gray-200 cursor-pointer w-full text-start" role="menuitem" id="mode-light" data-mode-option="light">
                                Light
                            </button>
                            <button class="rounded-b-[4px] p-4 hover:bg-gray-200 cursor-pointer w-full text-start" role="menuitem" id="mode-light" data-mode-option="dark">
                                Dark
                            </button>
                            <button class="rounded-b-[4px] p-4 hover:bg-gray-200 cursor-pointer w-full text-start" role="menuitem" id="mode-light" data-mode-option="system">
                                System
                            </button>
                        </el-menu>
                    </div>
                </el-dropdown> --}}
                <div class=" flex items-center justify-center">
                    <div class="relative inline-block text-left">
                        <button id="mode-menu-button">
                            <div
                                class="inline-flex justify-center w-full px-2 py-2 text-sm font-medium bg-white dark:bg-black border border-gray-300 dark:border-gray-600 cursor-pointer rounded-lg  ">
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
                        </button>
                        <div id="mode-menu" role="menu"
                            class="origin-top-right hidden absolute hidd right-0 mt-2 w-35 rounded-md shadow-lg bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-600">
                            <div class="py-2 p-2" role="menu" aria-orientation="vertical"
                                aria-labelledby="dropdown-button">
                                <a class="flex rounded-md px-2 py-2 text-sm text-gray-700  dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-blue-100 cursor-pointer"
                                    role="menuitem" id="mode-light" data-mode-option="light">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="light"
                                        width="18px" class="mr-2 dark:fill-amber-50">
                                        <path
                                            d="M19 9.199h-.98c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799H19c.552 0 1-.357 1-.799 0-.441-.449-.801-1-.801zM10 4.5A5.483 5.483 0 0 0 4.5 10c0 3.051 2.449 5.5 5.5 5.5 3.05 0 5.5-2.449 5.5-5.5S13.049 4.5 10 4.5zm0 9.5c-2.211 0-4-1.791-4-4 0-2.211 1.789-4 4-4a4 4 0 0 1 0 8zm-7-4c0-.441-.449-.801-1-.801H1c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799h1c.551 0 1-.358 1-.799zm7-7c.441 0 .799-.447.799-1V1c0-.553-.358-1-.799-1-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1zm0 14c-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1 .441 0 .799-.447.799-1v-1c0-.553-.358-1-.799-1zm7.365-13.234c.391-.391.454-.961.142-1.273s-.883-.248-1.272.143l-.7.699c-.391.391-.454.961-.142 1.273s.883.248 1.273-.143l.699-.699zM3.334 15.533l-.7.701c-.391.391-.454.959-.142 1.271s.883.25 1.272-.141l.7-.699c.391-.391.454-.961.142-1.274s-.883-.247-1.272.142zm.431-12.898c-.39-.391-.961-.455-1.273-.143s-.248.883.141 1.274l.7.699c.391.391.96.455 1.272.143s.249-.883-.141-1.273l-.699-.7zm11.769 14.031l.7.699c.391.391.96.453 1.272.143.312-.312.249-.883-.142-1.273l-.699-.699c-.391-.391-.961-.455-1.274-.143s-.248.882.143 1.273z">
                                        </path>
                                    </svg> Light
                                </a>
                                <a class="flex rounded-md px-2 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-blue-100 cursor-pointer"
                                    role="menuitem" id="mode-light" data-mode-option="dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="moon"
                                        width="18px" class="mr-2 dark:fill-amber-50">
                                        <path
                                            d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z">
                                        </path>
                                    </svg> Dark
                                </a>
                                <a class="flex rounded-md px-2 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-blue-100 cursor-pointer"
                                    role="menuitem" id="mode-light" data-mode-option="system">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="mr-2 dark:fill-amber-50"
                                        viewBox="0 0 32 32" id="desktop">
                                        <path
                                            d="M30 2H2a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2h9.998c-.004 1.446-.062 3.324-.61 4h-.404A.992.992 0 0 0 10 29c0 .552.44 1 .984 1h10.03A.992.992 0 0 0 22 29c0-.552-.44-1-.984-1h-.404c-.55-.676-.606-2.554-.61-4H30a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM14 24l-.002.004L14 24zm4.002.004L18 24h.002v.004zM30 20H2V4h28v16z">
                                        </path>
                                    </svg> System
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <el-dropdown class="relative inline-block">
                    <div class="w-10 h-10 rounded-full border border-gray-700 cursor-pointer justify-between">
                        <button class="cursor-pointer">
                            <img alt="tania andrew"
                                src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1480&amp;q=80"
                                class="relative inline-block h-10 w-10 rounded-full object-cover object-center" />
                        </button>
                        <el-menu id="dropdownMenu" anchor="bottom end" popover
                            class="m-0 w-[350px] origin-top-rig rounded-md bg-white p-0 shadow-lg ring-1 ring-black/5 transition [--anchor-gap:theme(spacing.2)] [transition-behavior:allow-discrete] focus:outline-none data-[closed]:scale-95 data-[closed]:transform data-[closed]:opacity-0 data-[enter]:duration-100 data-[leave]:duration-75 data-[enter]:ease-out data-[leave]:ease-in">
                            <div class="rounded-t-[4px] px-4 pt-4 pb-1 flex gap-[10px]"> <img alt="tania andrew"
                                    src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1480&amp;q=80"
                                    class="relative inline-block h-10 w-10 rounded-full object-cover object-center" />
                                <div class="flex flex-col">
                                    <h1>{{ auth()->user()->email }}</h1>
                                    <p>{{ auth()->user()->name }}</p>
                                </div>

                            </div>
                            <button class="rounded-b-[4px] p-4 hover:bg-gray-200 cursor-pointer w-full text-start">
                                Setting
                            </button>
                            <button class="rounded-b-[4px] p-4 hover:bg-gray-200 cursor-pointer w-full text-start"
                                wire:click="logout">
                                Logout
                            </button>
                        </el-menu>
                    </div>
                </el-dropdown>


            </div>
        </header>

    </div>


</div>
