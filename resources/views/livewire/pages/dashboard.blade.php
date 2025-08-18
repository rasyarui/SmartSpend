<div>
    <div class="flex">
        {{-- Modal --}}
        <div id="crud-modal" wire:click.self="closeModal" tabindex="-1" x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full h-full md:inset-0 max-h-full bg-black/60">
            <div class="relative p-4 w-full max-w-md max-h-full z-90">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 ">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $transactionType === 'income' ? 'Tambah Penghasilan' : 'Tambah Pengeluaran' }}
                        </h3>
                        <button type="button"wire:click="closeModal"
                            class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" wire:submit.prevent="saveTransaction">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="price" id="price" wire:model="amount"
                                    class="bg-transparent border border-gray-300 outline-none text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5 dark:border-gray-500 dark:placeholder-white dark:text-white dark:focus:ring-white dark:focus:border-white dark:focus:ring-1"
                                    placeholder="Rp 0">
                                @error('amount')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <button id="dropdownSearchButton" wire:click="openCategoryDropdown"
                                    data-dropdown-placement="bottom"
                                    class="bg-transparent border cursor-pointer border-gray-300 text-gray-900 text-sm text-center items-center inline-flex rounded-lg focus:ring-black focus:border-black w-full p-2.5 dark:border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-600 dark:placeholder-white dark:text-white dark:focus:ring-white dark:focus:border-white dark:focus:ring-1 focus:ring-1"
                                    type="button">

                                    @if ($category)
                                        <span class="text-left flex-1" wire:model="category">{{ $category }}</span>
                                    @else
                                        <span class="text-left flex-1 text-gray-400">Category Select</span>
                                    @endif

                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                @error('category_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                <div id="dropdownSearch" tabindex="-1" x-data="{ show: @entangle('showCategoryDropdown') }" x-show="show" x-cloak
                                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="show = false"
                                    class="z-10 bg-white absolute mt-[10px] rounded-lg shadow-sm w-60 border dark:border-gray-500 dark:bg-gray-700">
                                    <div class="flex flex-row gap-1.5 py-3 rounded-sm">
                                        <label for="input-group-search" class="sr-only">Search Category...</label>
                                        <div
                                            class="inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input class="relative w-full outline-none placeholder-gray-400"
                                            wire:model.live="categorySearch" placeholder="Search Category...">
                                    </div>

                                    <div class="mb-1">
                                        <label for="input-group-search" class="sr-only">Tambah Kategori Baru</label>
                                        <div
                                            class="relative w-full flex flex-row rounded-sm border border-x-0 py-3 cursor-pointer border-gray-500 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <div class="inset-y-0 start-0 flex items-center ps-2 pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="#fff"
                                                        d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
                                                </svg>
                                            </div>
                                            <button class="cursor-pointer text-md text-gray-400"
                                                wire:click="openCategoryModal" type="button">
                                                Tambah Kategori Baru
                                            </button>
                                        </div>
                                    </div>



                                    @if ($categories->count() > 0)
                                        <ul class="h-fit px-2 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownSearchButton">
                                            @foreach ($categories as $category)
                                                <li wire:click="selectCategory('{{ $category->id }}', '{{ $category->category }}')"
                                                    class="cursor-pointer">
                                                    <div @click="show = false"
                                                        class="flex items-center ps-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                                        <label
                                                            class="w-full py-2 ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">
                                                            {{ $category->category }}
                                                        </label>

                                                        <!-- Indicator jika kategori dipilih -->
                                                        @if ($category_id == $category->id)
                                                            <svg class="w-4 h-4 text-green-500 mr-2"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="h-fit px-2 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownSearchButton">
                                            <li>
                                                <div class="flex items-center ps-2 rounded-lg">
                                                    <label
                                                        class="w-full py-2 ms-2 text-sm font-medium text-gray-400 rounded-sm">
                                                        @if (empty($categorySearch))
                                                            Belum ada Category
                                                        @else
                                                            Tidak ada kategori yang cocok
                                                        @endif
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                </div>

                            </div>



                            <div class="col-span-1 sm:col-span-1" wire:ignore.self>
                                <label for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transaction
                                    Date</label>
                                <div class="relative max-w-sm">
                                    <input id="datepicker-actions" datepicker datepicker-format="yyyy-mm-dd"
                                        type="text" x-on:change="$wire.set('transaction_date', $el.value)"
                                        autocomplete="off" {{-- value="{{ \Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, d M Y') }}" --}}
                                        class="bg-transparent border outline-none border-gra    y-300 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-600 dark:placeholder-white dark:text-white dark:focus:ring-white dark:focus:border-white dark:focus:ring-1"
                                        placeholder="Select date">
                                    @error('transaction_date')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror

                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-black/40 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                    Description</label>
                                <textarea id="description" rows="4" wire:model="description"
                                    class="block p-2.5 outline-none w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 focus:ring-black focus:border-black  dark:border-gray-500 dark:placeholder-white dark:text-white dark:focus:ring-white dark:focus:border-white dark:focus:ring-1"
                                    placeholder="Write product description here"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>
                        <button type="submit" wire:loading.attr="disabled"
                            class="text-white inline-flex items-center cursor-pointer {{ $transactionType === 'income' ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <span wire:loading.remove wire:target="saveTransaction">
                                {{ $transactionType === 'income' ? 'Tambah Penghasilan' : 'Tambah Pengeluaran' }}
                            </span>
                            <span wire:loading wire:target="saveTransaction">
                                <div role="status">
                                    <svg aria-hidden="true"
                                        class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                </div>
                            </span>

                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="crud-modal CategoryModal" tabindex="-1" x-data="{ show: @entangle('showCategoryModal') }" x-show="show" x-cloak
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            wire:click.self="closeCategoryModal"
            class="fixed inset-0 z-51 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full h-full md:inset-0 max-h-full bg-black/75">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $transactionType === 'income' ? 'Tambah Category Penghasilan' : 'Tambah Category Pengeluaran' }}
                        </h3>
                        <button type="button" wire:click.self="closeCategoryModal"
                            class="text-gray-400 bg-transparent cursor-pointer hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" wire:submit.prevent="saveNewCategory">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="categoy"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <input type="text" name="category" id="category" wire:model="category"
                                    class="bg-transparent border border-gray-300 outline-none text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full p-2.5 dark:border-gray-500 placeholder-gray-400  dark:text-white dark:focus:ring-white dark:focus:border-white dark:focus:ring-1"
                                    placeholder="Create a new category" required>
                                @error('category')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center cursor-pointer {{ $transactionType === 'income' ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Buat
                        </button>
                        <button type="button" wire:click="closeCategoryModal"
                            class="text-black inline-flex items-center cursor-pointer dark:text-[#fafafa] dark:bg-gray-500 bg-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Close
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Modal --}}


        <div class="flex h-screen">
            <!-- Sidebar -->
            <aside
                class="sidebar fixed inset-y-0 left-0 z-2 w-64 overflow-y-auto bg-white text-black p-6 transition-transform duration-300 transform -translate-x-full md:translate-x-0 md:static md:flex-shrink-0"
                aria-label="Sidebar navigation">
                <div class="flex items-center mb-4 mt-[20px] space-x-3">

                    <a href="#"
                        class="flex items-center rounded-md px-2 py-[4px] text-black font-semibold hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-green-500 md:hidden absolute right-[10px] top-[10px]"
                        aria-current="page">
                        <p class="fa-solid">x</p>
                    </a>

                    <!-- Icon Container -->
                    <div class=" rounded-lg shrink-0">
                        <img src="/img/SmartSpend.png" alt="" width="80px">
                    </div>

                    <span class="flex flex-col">
                        <h1 class="text-3xl font-extrabold text-[#261c66] leading-tight max-w-[10rem]">
                            Smart
                        </h1>
                        <h1 class="text-3xl font-extrabold text-[#4054bb] leading-tight max-w-[10rem] ">
                            Spend
                        </h1>
                    </span>

                </div>

                <nav>
                    <h2 class="uppercase text-slate-600 font-semibold mb-4 tracking-wide text-sm select-none">Menu
                    </h2>
                    <ul class="space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 rounded-md bg-slate-700 px-4 py-2 text-white font-semibold hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-green-500"
                                aria-current="page">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <rect x="3" y="3" width="7" height="7" rx="1" ry="1" />
                                    <rect x="14" y="3" width="7" height="7" rx="1"
                                        ry="1" />
                                    <rect x="14" y="14" width="7" height="7" rx="1"
                                        ry="1" />
                                    <rect x="3" y="14" width="7" height="7" rx="1"
                                        ry="1" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 rounded-md px-4 py-2 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-slate-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16m-6-6l6 6-6 6" />
                                </svg>
                                Transaksi
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 rounded-md px-4 py-2 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-slate-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9 6 9-6" />
                                </svg>
                                Kelola
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 rounded-md px-4 py-2 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-slate-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 11c1.38 0 2.5-1.12 2.5-2.5S17.38 6 16 6 13.5 7.12 13.5 8.5 14.62 11 16 11zM8 20h8M6 13c0-1 1-1 1-1s-1-1-1-1" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 11v2m9-8v2m-6 8v1m3-10v10m6-10v10" />
                                </svg>
                                Tabunganku
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-3 rounded-md px-4 py-2 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 text-slate-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-9a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Riwayat
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>
        </div>

        <!-- Main Content -->
        <main class="min-h-screen w-full ">

            <div id="background-slider" wire:ignore
                class="fixed inset-0 -z-10 flex transition-transform duration-1000 ease-in-out">
                <div id="slide-light" class="w-full h-full flex-shrink-0 bg-white"></div>
                <div id="slide-dark" class="w-full h-full flex-shrink-0 bg-gray-950"></div>
            </div>
            <!-- Header -->
            <livewire:navbar />
            <!-- Hero section -->
            <section
                class="px-6 py-8 border-b border-gray-700 max-w-7xl mx-auto w-full flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="max-w-xl">
                    <h2 class="text-3xl font-extrabold mb-2 transition-colors duration-1000">
                        Hai, {{ auth()->user()->name }} <span aria-label="raised hands" role="img">🙌</span>
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-xl transition-colors duration-1000">Lacak keuanganmu dengan mudah sekarang!
                        Kelola pemasukan
                        &
                        pengeluaran tanpa stres. Yuk, mulai lebih rapi hari ini!</p>
                    <div class="flex gap-4 flex-wrap transition-colors duration-1000">
                        <button type="button" wire:click="openModal('income')"
                            class="bg-teal-800 hover:bg-teal-700 cursor-pointer transition text-white font-semibold px-5 py-2 rounded flex items-center gap-2 whitespace-nowrap">
                            Tambah Penghasilan <span aria-label="money with wings" role="img">🪙</span>
                        </button>
                        <button type="button" wire:click="openModal('expense')"
                            class="border border-red-600 hover:bg-red-700 cursor-pointer transition text-red-400 hover:text-white font-semibold px-5 py-2 rounded flex items-center gap-2 whitespace-nowrap">
                            Tambah Pengeluaran <span aria-label="worried face" role="img">🥵</span>
                        </button>
                    </div>
                </div>
                <aside
                    class="dark:bg-[#27272a] bg-[#f4f4f5] shadow-xl rounded-md p-4 text-gray-500 dark:text-gray-400 max-w-md italic select-none transition-colors duration-1000">
                    <p><span aria-label="light bulb" role="img">💡</span> “It’s not how much money you make,
                        but how
                        much money you keep.”</p>
                    <footer class="text-gray-500 dark:text-gray-400 mt-2 text-right font-light">– Robert Kiyosaki
                    </footer>
                </aside>
            </section>

            <!-- Summary section -->
            <section class="px-6 py-8 max-w-7xl mx-auto w-full flex flex-col gap-6">
                <livewire:card-transaction />
            </section>

            {{-- Table --}}
            <div class="w-full">
                <!-- Card Header -->
                <div class="px-6 py-2 space-y-4 relative">
                    <div class="flex flex-col items-start">
                        <div class="mb-5">
                            <h2 class="text-3xl font-extrabold text-black dark:text-white transition-colors duration-1000">Tabel Transaksi</h2>
                            <p class="text-[15px] text-gray-500 dark:text-gray-400 transition-colors duration-1000">Daftar semua transaksi keuangan</p>
                        </div>

                        <div class="flex flex-row w-full justify-between mb-2">
                            <div class="flex flex-row gap-3">
                                <button id="kategori-btn"
                                    class="flex cursor-pointer items-center gap-1 px-3 border border-gray-200 dark:border-gray-700 rounded-md bg-white dark:bg-gray-950 text-gray-950 font-semibold dark:text-white text-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500  transition-colors duration-1000"
                                    title="Export data ke Excel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        class="fill-gray-950 dark:fill-white transition-colors duration-1000" viewBox="0 0 24 24">
                                        <path fill=""
                                            d="M5 11q-.825 0-1.412-.587T3 9V5q0-.825.588-1.412T5 3h4q.825 0 1.413.588T11 5v4q0 .825-.587 1.413T9 11zm0 10q-.825 0-1.412-.587T3 19v-4q0-.825.588-1.412T5 13h4q.825 0 1.413.588T11 15v4q0 .825-.587 1.413T9 21zm10-10q-.825 0-1.412-.587T13 9V5q0-.825.588-1.412T15 3h4q.825 0 1.413.588T21 5v4q0 .825-.587 1.413T19 11zm0 10q-.825 0-1.412-.587T13 19v-4q0-.825.588-1.412T15 13h4q.825 0 1.413.588T21 15v4q0 .825-.587 1.413T19 21z" />
                                    </svg>
                                    Kategory
                                </button>
                                <button id="type-button" data-dropdown-toggle="dropdownSearchType"
                                    class="flex cursor-pointer items-center gap-1 px-3 border border-gray-200 dark:border-gray-700 rounded-md bg-white dark:bg-gray-950 text-gray-950 font-semibold dark:text-white text-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-1000"
                                    title="Export data ke Excel">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        class="fill-gray-950 dark:fill-white transition-colors duration-1000" viewBox="0 0 24 24">
                                        <path fill=""
                                            d="M5 11q-.825 0-1.412-.587T3 9V5q0-.825.588-1.412T5 3h4q.825 0 1.413.588T11 5v4q0 .825-.587 1.413T9 11zm0 10q-.825 0-1.412-.587T3 19v-4q0-.825.588-1.412T5 13h4q.825 0 1.413.588T11 15v4q0 .825-.587 1.413T9 21zm10-10q-.825 0-1.412-.587T13 9V5q0-.825.588-1.412T15 3h4q.825 0 1.413.588T21 5v4q0 .825-.587 1.413T19 11zm0 10q-.825 0-1.412-.587T13 19v-4q0-.825.588-1.412T15 13h4q.825 0 1.413.588T21 15v4q0 .825-.587 1.413T19 21z" />
                                    </svg>
                                    Tipe
                                </button>
                                <div id="dropdownSearchType" role="menu"
                                    class="origin-top-right hidden absolute right-0 mt-2 w-50 rounded-md shadow-lg bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-600">
                                    <div class="flex flex-col gap-2 items-center p-2 rounded-sm">
                                        <button
                                            class="flex flex-row ho ver:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer">
                                            <input id="checkbox-item-1" type="checkbox"
                                                wire:model.live="filter_types" value="income"
                                                class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-950 dark:border-gray-500  ">
                                            <label for="checkbox-item-1"
                                                class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">Penghasilan</label>
                                        </button>
                                        <button
                                            class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 p-1 rounded-md items-center cursor-pointer">
                                            <input id="checkbox-item-2" type="checkbox"
                                                wire:model.live="filter_types" value="expense"
                                                class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-950 dark:border-gray-500 ">
                                            <label for="checkbox-item-2"
                                                class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">Pengeluaran</label>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Dropdown -->
                            <div class="flex flex-row gap-3">
                                <!-- Export Button -->
                                <button id="export-btn"
                                    class="flex cursor-pointer items-center gap-2 px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-md bg-white dark:bg-gray-950 text-gray-950 font-semibold dark:text-white text-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-1000"
                                    title="Export data ke Excel">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Export Excel
                                </button>
                                <div class="relative">
                                    <button data-dropdown-toggle="dropdownView"
                                        class="items-cente flex cursor-pointer px-3 py-2 border gap-1 border-gray-200 dark:border-gray-700 rounded-md bg-white dark:bg-gray-950 text-gray-950 font-semibold dark:text-white text-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none transition-colors duration-1000">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" class="fill-gray-950 dark:fill-white transition-colors duration-1000"
                                            viewBox="0 0 24 24"> 
                                            <path 
                                                d="M12 18.88a1 1 0 0 1-.29.83a1 1 0 0 1-1.41 0l-4-4a1 1 0 0 1-.3-.84V9.75L1.21 3.62a1 1 0 0 1 .17-1.4A1 1 0 0 1 2 2h14a1 1 0 0 1 .62.22a1 1 0 0 1 .17 1.4L12 9.75zM4 4l4 5.06v5.52l2 2V9.05L14 4m-1 12l5 5l5-5Z" />
                                        </svg>
                                        View
                                    </button>
                                    <div id="dropdownView" role="menu"
                                        class="origin-top-right hidden absolute mt-2 mr-[50px] w-[150px] rounded-md shadow-lg bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-600">
                                        <div
                                            class="font-bold text-[14px] border-b border-gray-300 p-2 dark:border-gray-600 w-full text-center">
                                            Toggle Columns
                                        </div>
                                        <div class="flex flex-col gap-2 p-2 rounded-sm">
                                            <button
                                                class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer">
                                                <input id="checkbox-view-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-950 dark:border-gray-500  ">
                                                <label for="checkbox-view-1"
                                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">Katrgori</label>
                                            </button>
                                            <button
                                                class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer">
                                                <input id="checkbox-view-2" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-950 dark:border-gray-500 ">
                                                <label for="checkbox-view-2"
                                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">Deskripsi</label>
                                            </button>
                                            <button
                                                class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer">
                                                <input id="checkbox-view-3" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-950 dark:border-gray-500 ">
                                                <label for="checkbox-view-3"
                                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">Tanggal</label>
                                            </button>
                                            <button
                                                class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer">
                                                <input id="checkbox-view-4" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-950 dark:border-gray-500 ">
                                                <label for="checkbox-view-4"
                                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">Tipe</label>
                                            </button>
                                            <button
                                                class="flex flex-row hover:bg-gray-100 dark:hover:bg-gray-600 py-1 px-3 rounded-md items-center cursor-pointer">
                                                <input id="checkbox-view-5" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-950 dark:border-gray-500 ">
                                                <label for="checkbox-view-5"
                                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">Jumlah</label>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <!-- Card Content -->
                <div class="px-6 pb-6">
                    <!-- Table Container with horizontal scroll -->
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                        <div class="overflow-x-auto table-container">
                            <table class="w-full min-w-full">
                                <thead>
                                    <tr
                                        class="bg-gray-50 dark:bg-gray-950 border-b border-gray-200 dark:border-gray-700">
                                        <th
                                            class="px-4 py-3 text-left text-sm font-medium text-gray-900 dark:text-gray-400">
                                            Kategori
                                        </th>
                                        <th
                                            class="px-4 py-3 text-left text-sm font-medium text-gray-900 dark:text-gray-400">
                                            Deskripsi</th>
                                        <th
                                            class="px-4 py-3 text-left text-sm font-medium text-gray-900 dark:text-gray-400">
                                            Tanggal</th>
                                        <th
                                            class="px-4 py-3 text-left text-sm font-medium text-gray-900 dark:text-gray-400">
                                            Tipe</th>
                                        <th
                                            class="px-4 py-3 text-right text-sm font-medium text-gray-900 dark:text-gray-400">
                                            Jumlah</th>
                                        <th
                                            class="px-4 py-3 text-center text-sm font-medium text-gray-900 dark:text-gray-400 w-[70px]">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody
                                    id="transaction-tbody"class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-950">
                                    @forelse ($transactions as $dataTransaction)
                                        <tr class="table-row border-b border-gray-200 dark:border-gray-700">
                                            <td class="px-3 py-3">
                                                @unless (in_array('category_id', $hiddenColumns))
                                                    <span
                                                        class="font-medium text-gray-500  dark:text-gray-400">{{ $dataTransaction->category->category }}</span>
                                                @endunless

                                            </td>
                                            <td class="px-3 py-3">
                                                <span
                                                    class="text-gray-500 dark:text-gray-400">{{ $dataTransaction->description }}</span>
                                            </td>
                                            <td class="px-3 py-3 text-gray-900 dark:text-white">
                                                {{-- {{ $dataTransaction->transaction_date }} --}}
                                                <span class="text-gray-500 dark:text-gray-400">
                                                    {{ \Carbon\Carbon::parse($dataTransaction->transaction_date)->translatedFormat('d M Y') }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-3">
                                                <div
                                                    class="w-full px-2 py-0.5 text-center text-md rounded-md {{ $dataTransaction->type == 'income' ? 'bg-[#DCFCE7] dark:bg-[#14532D] hover:bg-green-600 dark:text-[#BBF7D0] text-[#166534]' : 'bg-[#FEE2E2] dark:bg-[#7F1D1D] hover:bg-red-600 text-[#991B1B] dark:text-[#FCA5A5]' }}">
                                                    <span class=" ">{{ $dataTransaction->type }}</span>
                                                </div>
                                            </td>
                                            <td class="px-3 py-3 text-right font-medium">
                                                <span
                                                    class="{{ $dataTransaction->type == 'income' ? ' text-green-500' : 'text-red-500' }}">
                                                    @if ($dataTransaction->type == 'income')
                                                        +Rp {{ number_format($dataTransaction->amount) }},00
                                                    @else
                                                        -Rp {{ number_format($dataTransaction->amount) }},00
                                                    @endif

                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <button onclick="deleteTransaction(${transaction.id})"
                                                    class="h-8 w-8 p-0 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors duration-200"
                                                    title="Hapus transaksi">
                                                    <svg class="h-4 w-4 mx-auto" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
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

                    <!-- Pagination -->
                    <div class="flex-col sm:flex-row w-full pt-2 border-gray-200 dark:border-gray-700 mt-2">
                        {{ $transactions->links(data: ['scrollTo' => false]) }}

                    </div>

                </div>
            </div>
        </main>
    </div>
</div>
