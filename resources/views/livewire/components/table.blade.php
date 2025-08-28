<div>
    {{-- Notif Loading --}}
    <div x-init="setTimeout(() => show = false, 5000)" wire:loading.delay wire:target="deleteTransaction">
        <div class="notification" id="notif">
            <div class="notification-content">
                <div role="status">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
                <div class="message">
                    <span class="text text-md">Deleting Transaction.....</span>
                </div>
            </div>
            <div class="progressBarLoading"></div>
        </div>
    </div>

    @if (session()->has('successD'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            <div class="notification" id="notif">
                <div class="notification-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 48 48">
                        <defs>
                            <mask id="ipSCheckOne0">
                                <g fill="none" stroke-linejoin="round" stroke-width="4">
                                    <path fill="#fff" stroke="#fff"
                                        d="M24 44a19.937 19.937 0 0 0 14.142-5.858A19.937 19.937 0 0 0 44 24a19.938 19.938 0 0 0-5.858-14.142A19.937 19.937 0 0 0 24 4A19.938 19.938 0 0 0 9.858 9.858A19.938 19.938 0 0 0 4 24a19.937 19.937 0 0 0 5.858 14.142A19.938 19.938 0 0 0 24 44Z" />
                                    <path stroke="#000" stroke-linecap="round" d="m16 24l6 6l12-12" />
                                </g>
                            </mask>
                        </defs>
                        <path fill="#7c84f4" d="M0 0h48v48H0z" mask="url(#ipSCheckOne0)" />
                    </svg>
                    <div class="message">
                        <span class="text">{{ session('successD') }}</span>
                    </div>
                </div>
                <div class="progressBar"></div>
            </div>
        </div>
    @endif


    <div class="px-6 py-2 space-y-4 relative">
        <div class="flex flex-col items-start">

            <div class="mb-5">
                <div class="flex items-center gap-2 mb-2">
                    <div
                        class="p-3 w-fit rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-theme hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-database-icon lucide-database h-5 w-5 text-white">
                            <ellipse cx="12" cy="5" rx="9" ry="3" />
                            <path d="M3 5V19A9 3 0 0 0 21 19V5" />
                            <path d="M3 12A9 3 0 0 0 21 12" />
                        </svg>
                    </div>
                    <h2
                        class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Tabel Transaksi</h2>
                </div>
                <p class="text-[15px] text-gray-500 dark:text-gray-400 ">
                    Daftar semua transaksi keuangan</p>
            </div>

            <div class="flex flex-row w-full justify-between mb-2">
                <div class="flex flex-row gap-3">
                    <div class="relative" x-data="{ openCategory: false }">
                        <button id="type-button" @click="openCategory = !openCategory"
                            class="items-center flex justify-center font-semibold text-sm cursor-pointer px-5 py-2 border-[1px] gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:transform hover:scale-105 rounded-lg hover:shadow-xl transition-all duration-400"
                            title="Tipe">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                class="fill-gray-950 dark:fill-white " viewBox="0 0 24 24">
                                <path fill=""
                                    d="M5 11q-.825 0-1.412-.587T3 9V5q0-.825.588-1.412T5 3h4q.825 0 1.413.588T11 5v4q0 .825-.587 1.413T9 11zm0 10q-.825 0-1.412-.587T3 19v-4q0-.825.588-1.412T5 13h4q.825 0 1.413.588T11 15v4q0 .825-.587 1.413T9 21zm10-10q-.825 0-1.412-.587T13 9V5q0-.825.588-1.412T15 3h4q.825 0 1.413.588T21 5v4q0 .825-.587 1.413T19 11zm0 10q-.825 0-1.412-.587T13 19v-4q0-.825.588-1.412T15 13h4q.825 0 1.413.588T21 15v4q0 .825-.587 1.413T19 21z" />
                            </svg>
                            Category

                            <template
                                x-if="typeof $wire.filter_category !== 'undefined' && $wire.filter_category.length > 0">
                                <span
                                    class="ml-2 px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                                    <p
                                        x-text="$wire.filter_category.length === 2 ? 'Semua Category' : $wire.filter_category.join(', ')">
                                    </p>

                                </span>
                            </template>
                        </button>
                        <div role="menu" x-show="openCategory" @click.outside="openCategory = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            x-cloak=""
                            class="origin-top-left glass absolute left-0 mt-2 w-40 rounded-md shadow-lg border border-gray-300 z-99">
                            <div class="flex flex-col gap-2 items-center p-2 rounded-sm">
                                @forelse ($categories as $category)
                                    <button
                                        class="flex  hover:bg-gray-100 dark:hover:bg-[#94A3B81A] w-full gap-2 items-center p-1 rounded-md  cursor-pointer">
                                        <input id="category-{{ $category->category }}" wire:model.live="filter_category"
                                            wire:key="category-checkbox-{{ $category->category }}"
                                            value="{{ $category->category }}" type="checkbox"
                                            class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                        <label for="category-{{ $category->category }}"
                                            class=" text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">{{ $category->category }}</label>
                                    </button>
                                    @empty
                                    <p class="text-xs text-gray-400 text-nowrap py-1">Kategori tidak tersedia..</p>
                                @endforelse
                                <template
                                    x-if="typeof $wire.filter_category !== 'undefined' && $wire.filter_category.length > 0">
                                    <button @click="$wire.filter_category = []" value="clear" wire:click="clearFilter"
                                        class="flex text-sm font-medium justify-center hover:bg-gray-100 dark:hover:bg-[#94A3B81A] w-full gap-2 items-center p-1 rounded-md  cursor-pointer">
                                        Clear Filter
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>


                    <div class="relative" x-data="{ openType: false }">
                        <button id="type-button" @click="openType = !openType"
                            class="items-center flex justify-center font-semibold text-sm cursor-pointer px-5 py-2 border-[1px] gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:transform hover:scale-105 rounded-lg hover:shadow-xl transition-all duration-400"
                            title="Tipe">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                class="fill-gray-950 dark:fill-white " viewBox="0 0 24 24">
                                <path fill=""
                                    d="M5 11q-.825 0-1.412-.587T3 9V5q0-.825.588-1.412T5 3h4q.825 0 1.413.588T11 5v4q0 .825-.587 1.413T9 11zm0 10q-.825 0-1.412-.587T3 19v-4q0-.825.588-1.412T5 13h4q.825 0 1.413.588T11 15v4q0 .825-.587 1.413T9 21zm10-10q-.825 0-1.412-.587T13 9V5q0-.825.588-1.412T15 3h4q.825 0 1.413.588T21 5v4q0 .825-.587 1.413T19 11zm0 10q-.825 0-1.412-.587T13 19v-4q0-.825.588-1.412T15 13h4q.825 0 1.413.588T21 15v4q0 .825-.587 1.413T19 21z" />
                            </svg>
                            Type

                            <template
                                x-if="typeof $wire.filter_types !== 'undefined' && $wire.filter_types.length > 0">
                                <span
                                    class="ml-2 px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                                    <p
                                        x-text="$wire.filter_types.length === 2 ? 'Semua Tipe' : $wire.filter_types.join(', ')">
                                    </p>
                                </span>
                            </template>
                        </button>
                        <div role="menu" x-show="openType" @click.outside="openType = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95" x-cloak=""
                            class="origin-top-left glass absolute left-0 mt-2 w-40 rounded-md shadow-lg border border-gray-300 z-99">
                            <div class="flex flex-col gap-2 items-center p-2 rounded-sm">
                                <button
                                    class="flex  hover:bg-gray-100 dark:hover:bg-[#94A3B81A] w-full gap-2 items-center p-1 rounded-md  cursor-pointer">
                                    <input id="checkbox-item-1" type="checkbox" wire:model.live="filter_types"
                                        value="income"
                                        class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                    <label for="checkbox-item-1"
                                        class=" text-sm flex gap-2 text-center items-center font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="lucide lucide-trending-up-icon lucide-trending-up h-4 w-4 text-green-400">
                                            <path d="M16 7h6v6" />
                                            <path d="m22 7-8.5 8.5-5-5L2 17" />
                                        </svg>

                                        Income</label>
                                </button>
                                <button
                                    class="flex  hover:bg-gray-100 dark:hover:bg-[#94A3B81A] w-full gap-2 items-center p-1 rounded-md  cursor-pointer">
                                    <input id="checkbox-item-2" type="checkbox" wire:model.live="filter_types"
                                        value="expense"
                                        class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-item-2"
                                        class=" text-sm flex gap-2 text-center items-center font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="lucide lucide-trending-down-icon lucide-trending-down h-4 w-4 text-red-400">
                                            <path d="M16 17h6v-6" />
                                            <path d="m22 17-8.5-8.5-5 5L2 7" />
                                        </svg>

                                        Expense</label>
                                </button>
                                <template
                                    x-if="typeof $wire.filter_types !== 'undefined' && $wire.filter_types.length > 0">
                                    <button @click="$wire.filter_types = []" value="clear" wire:click="clearFilter"
                                        class="flex text-sm font-medium justify-center hover:bg-gray-100 dark:hover:bg-[#94A3B81A] w-full gap-2 items-center p-1 rounded-md  cursor-pointer">
                                        Clear Filter
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Filter Dropdown -->
                <div class="flex flex-row gap-3">
                    <!-- Export Button -->
                    <button id="export-btn"
                        class="flex cursor-pointer hover:transform font-semibold text-sm hover:scale-105 items-center gap-2 text-[#f8fafc] dark:text-black rounded-lg px-4 py-2 bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 border-0 shadow-lg hover:shadow-xl transition-all duration-400"
                        title="Export data ke Excel">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export Excel
                    </button>

                    <div class="relative">
                        <button id="dropdown-button"
                            class="items-center flex justify-center font-semibold text-sm cursor-pointer px-5 py-2 border-[1px] gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:transform hover:scale-105 rounded-lg hover:shadow-xl transition-all duration-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17"
                                class="fill-gray-950 dark:fill-white " viewBox="0 0 24 24">
                                <path
                                    d="M12 18.88a1 1 0 0 1-.29.83a1 1 0 0 1-1.41 0l-4-4a1 1 0 0 1-.3-.84V9.75L1.21 3.62a1 1 0 0 1 .17-1.4A1 1 0 0 1 2 2h14a1 1 0 0 1 .62.22a1 1 0 0 1 .17 1.4L12 9.75zM4 4l4 5.06v5.52l2 2V9.05L14 4m-1 12l5 5l5-5Z" />
                            </svg>
                            View
                        </button>
                        <div id="dropdown-menu"
                            class="origin-top-left z-1 hidden absolute mt-2 right-0 w-35 rounded-md shadow-lg bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-600">
                            <div
                                class="font-bold text-[14px] border-b border-gray-300 p-2 dark:border-gray-600 w-full text-center">
                                Toggle Columns
                            </div>
                            <div class="flex flex-col gap-2 p-2 rounded-sm">
                                <button
                                    class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer text-start gap-2">
                                    <div for="checkbox-view-1" class="relative cursor-pointer">
                                        <input type="checkbox" id="checkbox-view-1" class="sr-only peer text-start"
                                            wire:click="toggleColumn('kategori')"
                                            {{ !in_array('kategori', $hiddenColumns) ? 'checked' : '' }} />
                                        <div
                                            class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                        </div>

                                        <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200 opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            class="absolute inset-0 h-full w-full text-gray-950 dark:fill-gray-200 opacity-100 transition-all duration-200 peer-checked:opacity-0 peer-checked:transform peer-checked:scale-110"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z" />
                                        </svg>
                                    </div>
                                    <label for="checkbox-view-1"
                                        class="cursor-pointer font-medium text-sm">Kategori</label>

                                </button>
                                <button
                                    class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer text-start gap-2">
                                    <div for="checkbox-view-2" class="relative cursor-pointer">
                                        <input type="checkbox" id="checkbox-view-2" class="sr-only peer text-start"
                                            wire:click="toggleColumn('deskripsi')"
                                            {{ !in_array('deskripsi', $hiddenColumns) ? 'checked' : '' }} />
                                        <div
                                            class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                        </div>

                                        <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            class="absolute inset-0 h-full w-full text-gray-950 dark:fill-gray-200  opacity-100 transition-all duration-200 peer-checked:opacity-0 peer-checked:transform peer-checked:scale-110"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z" />
                                        </svg>
                                    </div>
                                    <label for="checkbox-view-2"
                                        class="cursor-pointer font-medium text-sm">Deskripsi</label>
                                </button>
                                <button
                                    class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer text-start gap-2">
                                    <div for="checkbox-view-3" class="relative cursor-pointer">
                                        <input type="checkbox" id="checkbox-view-3" class="sr-only peer text-start"
                                            wire:click="toggleColumn('tanggal')"
                                            {{ !in_array('tanggal', $hiddenColumns) ? 'checked' : '' }} />
                                        <div
                                            class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                        </div>

                                        <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            class="absolute inset-0 h-full w-full text-gray-950 dark:fill-gray-200  opacity-100 transition-all duration-200 peer-checked:opacity-0 peer-checked:transform peer-checked:scale-110"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z" />
                                        </svg>
                                    </div>
                                    <label for="checkbox-view-3"
                                        class="cursor-pointer font-medium text-sm">Tanggal</label>
                                </button>
                                <button
                                    class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer text-start gap-2">
                                    <div for="checkbox-view-4" class="relative cursor-pointer">
                                        <input type="checkbox" id="checkbox-view-4" class="sr-only peer text-start"
                                            wire:click="toggleColumn('tipe')"
                                            {{ !in_array('tipe', $hiddenColumns) ? 'checked' : '' }} />
                                        <div
                                            class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                        </div>

                                        <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            class="absolute inset-0 h-full w-full text-gray-950 dark:fill-gray-200  opacity-100 transition-all duration-200 peer-checked:opacity-0 peer-checked:transform peer-checked:scale-110"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z" />
                                        </svg>
                                    </div>
                                    <label for="checkbox-view-4"
                                        class="cursor-pointer font-medium text-sm">Tipe</label>
                                </button>
                                <button
                                    class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer text-start gap-2">
                                    <div for="checkbox-view-5" class="relative cursor-pointer">
                                        <input type="checkbox" id="checkbox-view-5" class="sr-only peer text-start"
                                            wire:click="toggleColumn('jumlah')"
                                            {{ !in_array('jumlah', $hiddenColumns) ? 'checked' : '' }} />
                                        <div
                                            class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                        </div>

                                        <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            class="absolute inset-0 h-full w-full text-gray-950 dark:fill-gray-200  opacity-100 transition-all duration-200 peer-checked:opacity-0 peer-checked:transform peer-checked:scale-110"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z" />
                                        </svg>
                                    </div>
                                    <label for="checkbox-view-5"
                                        class="cursor-pointer font-medium text-sm">Jumlah</label>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Table Content -->
    <div class="px-6 pb-6">
        <!-- Table Container with horizontal scroll -->
        <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
            <div class="overflow-x-auto table-container ">
                <table
                    class="w-full min-w-full border border-white/10 rounded-lg overflow-hidden bg-white/5 backdrop-blur-sm">
                    <thead>
                        <tr
                            class=" border-b dark:border-gray-700 bg-gradient-to-r from-blue-500/10 to-purple-500/10 border-white/10 hover:bg-transparent">
                            @unless (in_array('kategori', $hiddenColumns))
                                <th class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                    Kategori </th>
                            @endunless
                            @unless (in_array('deskripsi', $hiddenColumns))
                                <th class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                    Deskripsi</th>
                            @endunless
                            @unless (in_array('tanggal', $hiddenColumns))
                                <th class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                    Tanggal</th>
                            @endunless
                            @unless (in_array('tipe', $hiddenColumns))
                                <th class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                    Tipe</th>
                            @endunless
                            @unless (in_array('jumlah', $hiddenColumns))
                                <th class="px-4 py-3 font-semibold text-right text-sm  text-gray-900 dark:text-[#f8fafc]">
                                    Jumlah</th>
                            @endunless

                            <th class="px-4 py-3 text-center text-sm  text-gray-900 dark:text-[#f8fafc] w-[70px]">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-tbody"class="divide-y divide-gray-200 dark:divide-gray-700 ">
                        @forelse ($transactions as $dataTransaction)
                            <tr
                                class="table-row border-b border-gray-200  dark:border-white/10 hover:bg-white/5 transition-all duration-300 group">
                                @unless (in_array('kategori', $hiddenColumns))
                                    <td class="px-3 py-3">
                                        <span
                                            class="font-medium text-[#0f172a] dark:text-[#f8fafc]">{{ $dataTransaction->category->category }}</span>

                                    </td>
                                @endunless
                                @unless (in_array('deskripsi', $hiddenColumns))
                                    <td class="px-3 py-3">
                                        <span
                                            class="text-gray-500 dark:text-gray-400">{{ $dataTransaction->description }}</span>

                                    </td>
                                @endunless

                                @unless (in_array('tanggal', $hiddenColumns))
                                    <td class="px-3 py-3 text-gray-900 dark:text-white">
                                        <span class="text-[#0f172a] dark:text-[#f8fafc]">
                                            {{ \Carbon\Carbon::parse($dataTransaction->transaction_date)->translatedFormat('d M Y') }}
                                        </span>

                                    </td>
                                @endunless
                                @unless (in_array('tipe', $hiddenColumns))
                                    <td class="px-3 py-3">
                                        <div
                                            class="w-full px-2 py-0.5 text-center text-md rounded-md {{ $dataTransaction->type == 'income' ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white border-0 shadow-lg' : 'bg-gradient-to-r from-red-500 to-pink-500 text-white border-0 shadow-lg' }}">
                                            <span class=" ">{{ $dataTransaction->type }}</span>
                                        </div>
                                    </td>
                                @endunless
                                @unless (in_array('jumlah', $hiddenColumns))
                                    <td class="px-3 py-3 text-right font-medium ">
                                        <span
                                            class="{{ $dataTransaction->type == 'income' ? ' text-green-400' : 'text-red-400' }}">
                                            @if ($dataTransaction->type == 'income')
                                                +Rp {{ number_format($dataTransaction->amount) }},00
                                            @else
                                                -Rp {{ number_format($dataTransaction->amount) }},00
                                            @endif

                                        </span>
                                    </td>
                                @endunless
                                <td class="px-4 py-3 text-center">
                                    <button wire:click="openModalDelete({{ $dataTransaction->id }})"
                                        class="h-8 w-8 p-0 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors duration-200"
                                        title="Hapus transaksi">
                                        <svg class="h-4 w-4 mx-auto" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="sr-only">Delete</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-md">
                                    No results.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div id="crud-modal" wire:click.self="closeModalDelete" tabindex="-1" x-data="{ show: @entangle('showModalDelete') }"
            x-show="show" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" wire:loading.remove
            wire:target="deleteTransaction"
            class="fixed inset-0 z-10 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full  h-full md:inset-0 max-h-full bg-black/60">
            <div
                class="glass border borde-border dark:border-gray-600 bg-gray-950/70 rounded-lg w-full max-w-md transform transition-all duration-300 scale-95 ">
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">

                    <div class="flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white ">
                            Apakah anda yakin ingin menghapus data
                        </h3>
                    </div>

                    <button type="button"wire:click="closeModalDelete"
                        class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="flex gap-5 pt-4 py-5 w-fit mx-auto">
                    <button type="submit" wire:click="deleteTransaction" x-cloak
                        class="text-white inline-flex items-center cursor-pointer bg-gradient-to-r from-red-500 to-pink-500 border-0 shadow-lg font-medium rounded-lg text-md px-4 py-1 text-center">
                        <span>
                            Delete
                        </span>
                      
                    </button>
                    <button type="button"wire:click="closeModalDelete"
                        class="glass bg-gray-950/70 cursor-pointer flex-1 px-4 py-2 rounded-lg border border-border hover:bg-muted/50  hover:text-purple-400">
                        Cancel
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex-col sm:flex-row  pt-2 border-gray-200 dark:border-gray-700 mt-2">
            {{ $transactions->links(data: ['scrollTo' => false]) }}
        </div>

    </div>
</div>
