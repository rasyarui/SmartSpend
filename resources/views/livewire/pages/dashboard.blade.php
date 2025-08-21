<div>
    <div class="flex h-screen">
        <button id="menu-btn" aria-label="Toggle sidebar" aria-expanded="false" aria-controls="sidebar"
            class="focus:outline-none fixed rounded-md top-4 left-4 bg-gray-950 border-gray-300 focus:ring-2 focus:ring-green-500 p-2  md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        {{-- Modal --}}
        <div id="crud-modal" wire:click.self="closeModal" tabindex="-1" x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full h-full md:inset-0 max-h-full bg-black/60">
            <div class="flex items-center justify-center p-4">
                <!-- Modal content -->
                <div
                    class="glass border borde-border dark:border-gray-600 bg-gray-950/70 rounded-lg w-full max-w-md transform transition-all duration-300 scale-95 ">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        @if ($transactionType === 'income')
                            <div class="p-2 mr-3 rounded-lg bg-gradient-to-br from-green-500 to-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-trending-up-icon lucide-trending-up">
                                    <path d="M16 7h6v6" />
                                    <path d="m22 7-8.5 8.5-5-5L2 17" />
                                </svg>
                            </div>
                        @else
                            <div class="p-2 mr-3 rounded-lg bg-gradient-to-br from-red-500 to-rose-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-trending-down-icon lucide-trending-down">
                                    <path d="M16 17h6v-6" />
                                    <path d="m22 17-8.5-8.5-5 5L2 7" />
                                </svg>
                            </div>
                        @endif


                        <div class="flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white ">
                                Tambah
                                <span class="{{ $transactionType === 'income' ? ' text-green-500' : ' text-red-500' }}">
                                    {{ $transactionType === 'income' ? ' Penghasilan' : ' Pengeluaran' }}
                                </span>
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                {{ $transactionType === 'income' ? ' Record your earnings and income' : 'Track your spending and expenses' }}
                            </p>
                        </div>

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
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="price" id="price" wire:model="amount"
                                    class="bg-transparent border border-gray-300 outline-none text-gray-900 text-sm font-medium rounded-lg block w-full p-2.5 dark:border-gray-500 dark:placeholder-white dark:text-white "
                                    placeholder="Rp 0">
                                @error('amount')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="category"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white ">Category</label>
                                <button id="dropdownSearchButton" wire:click="openCategoryDropdown"
                                    data-dropdown-placement="bottom"
                                    class="glass  border-border border cursor-pointer border-gray-300 text-gray-900 text-sm text-center items-center inline-flex rounded-lg focus:ring-black focus:border-black w-full p-2.5 dark:border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-600 dark:placeholder-white dark:text-white dark:focus:ring-white dark:focus:border-white dark:focus:ring-1 focus:ring-1"
                                    type="button">

                                    @if ($category)
                                        <span class="text-left flex-1 text-black dark:text-white font-medium"
                                            wire:model="category">{{ $category }}</span>
                                    @else
                                        <span class="text-left flex-1 text-black dark:text-white font-medium">Category
                                            Select</span>
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
                                <div id="dropdownSearch" tabindex="-1" x-data="{ show: @entangle('showCategoryDropdown') }" x-show="show"
                                    x-cloak x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0" @click.away="show = false"
                                    class="z-10 dark:bg-gray-950/70  absolute mt-[10px] rounded-lg shadow-sm w-60">
                                    <div
                                        class="glass border border-border rounded-lg w-full max-w-md transform transition-all duration-300">
                                        <div class="flex flex-row gap-1.5 py-3 rounded-sm">
                                            <label for="input-group-search" class="sr-only">Search Category...</label>
                                            <div
                                                class="inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                </svg>
                                            </div>
                                            <input
                                                class="search-input w-full bg-transparent border-b border-gray-300 dark:border-gray-600 rounded-none px-2 py-1.5 text-md placeholder-gray-400 dark:placeholder-gray-400 transition-colors"
                                                style="background-color: transparent;
                                                            input:focus:outline-none;"wire:model.live="categorySearch"
                                                placeholder="Search Category...">
                                        </div>

                                        <div class="mb-1">
                                            <label for="input-group-search" class="sr-only">Tambah Kategori
                                                Baru</label>
                                            <div
                                                class="relative w-full flex flex-row rounded-sm border border-x-0 py-3 cursor-pointer border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <div
                                                    class="inset-y-0 start-0 flex items-center ps-2 pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24"
                                                        class="fill-gray-400 dark:fill-white">
                                                        <path
                                                            d="M13 6a1 1 0 1 0-2 0v5H6a1 1 0 1 0 0 2h5v5a1 1 0 1 0 2 0v-5h5a1 1 0 1 0 0-2h-5z" />
                                                    </svg>
                                                </div>
                                                <button class="cursor-pointer font-semibold text-md text-gray-400"
                                                    wire:click="openCategoryModal" type="button">
                                                    Tambah Kategori Baru
                                                </button>
                                            </div>
                                        </div>



                                        @if ($categories->count() > 0)
                                            <ul class="h-fit px-2 pb-3 overflow-y-auto text-md text-gray-700 dark:text-gray-200"
                                                aria-labelledby="dropdownSearchButton">
                                                @foreach ($categories as $category)
                                                    <li wire:click="selectCategory('{{ $category->id }}', '{{ $category->category }}')"
                                                        class="cursor-pointer">
                                                        <div @click="show = false"
                                                            class="flex items-center ps-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                                            <label
                                                                class="w-full py-2 ms-2 text-md font-medium text-gray-950 rounded-sm dark:text-gray-300 cursor-pointer">
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
                                                    <div class="flex items-center rounded-lg">
                                                        <label
                                                            class="w-full py-2 ms-2 text-md font-medium text-black dark:text-gray-200 rounded-sm">
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

                            </div>



                            <div class="col-span-1 sm:col-span-1" wire:ignore.self>
                                <label for="category"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Transaction
                                    Date</label>
                                <div class="relative max-w-sm">
                                    <input id="datepicker-actions" datepicker datepicker-format="yyyy-mm-dd"
                                        type="text" x-on:change="$wire.set('transaction_date', $el.value)"
                                        autocomplete="off" {{-- value="{{ \Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, d M Y') }}" --}}
                                        class="bg-transparent border border-border outline-none border-gray-300 text-gray-900 text-sm font-medium rounded-lg block w-full ps-10 p-2.5 dark:placeholder-white placeholder:text-gray-900 dark:text-white"
                                        placeholder="Select date">
                                    @error('transaction_date')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror

                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-black/50 dark:text-white" aria-hidden="true"
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
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Product
                                    Description</label>
                                <textarea id="description" rows="4" wire:model="description"
                                    class="block p-2.5 outline-none w-full text-sm font-medium text-gray-900 bg-transparent rounded-lg border border-gray-300 dark:border-gray-500 dark:placeholder-white dark:text-white"
                                    placeholder="Write product description here"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                        <div class="flex gap-2 pt-4">
                            <button type="submit" wire:loading.attr="disabled"
                                class="text-white inline-flex items-center cursor-pointer {{ $transactionType === 'income' ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} font-medium rounded-lg text-md px-4 py-1 text-center">
                                @if ($transactionType === 'income')
                                    <div class="p-1 mr-1 rounded-lg" wire:loading.remove
                                        wire:target="saveTransaction">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-trending-up-icon lucide-trending-up">
                                            <path d="M16 7h6v6" />
                                            <path d="m22 7-8.5 8.5-5-5L2 17" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="p-1 mr-1 rounded-lg" wire:loading.remove
                                        wire:target="saveTransaction">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-trending-down-icon lucide-trending-down">
                                            <path d="M16 17h6v-6" />
                                            <path d="m22 17-8.5-8.5-5 5L2 7" />
                                        </svg>
                                    </div>
                                @endif

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
                            <button type="button"wire:click="closeModal"
                                class="glass bg-gray-950/70 cursor-pointer flex-1 px-4 py-2 rounded-lg border border-border hover:bg-muted/50 transition-colors duration-300 hover:text-purple-400">
                                Cancel
                            </button>
                        </div>

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

        <!-- Sidebar -->
        <nav id="sidebar"
            class="fixed left-0 top-0 h-full w-72 glass border-r border-border z-40 transition-all duration-300 transform -translate-x-full lg:translate-x-0">
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
            <div class="p-4 space-y-2">
                <a href=""
                    class="nav-item active flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
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

                <a href=""
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
                    data-page="transactions">
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

                <a href=""
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
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
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:scale-105"
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
            <div class="absolute bottom-20 left-4 right-4">
                <div class="p-3 rounded-lg glass border border-border transition-all duration-300">
                    <div class="flex items-center gap-2 text-xs">
                        <div id="theme-indicator" class="w-2 h-2 rounded-full animate-pulse bg-yellow-400"></div>
                        <span class="text-muted-foreground" id="theme-status">Light Theme Active</span>
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

        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button id="mobile-menu-btn"
                class="p-2 rounded-lg glass border border-border hover:bg-card transition-all duration-300 shadow-theme">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>
        </div>
        <!-- Main Content -->
        <main class="min-h-screen w-full lg:ml-72">

            <div class="background-slider fixed inset-0 pointer-events-none transition-all duration-300"
                id="background-slider" wire:ignore>
                <!-- Light Mode Background -->
                <div class="absolute inset-0 transition-opacity duration-300 light-bg" id="slide-light">
                    <!-- Light mode gradient orbs -->
                    <div
                        class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-blue-400/12 to-indigo-400/8 rounded-full blur-3xl animate-pulse">
                    </div>
                    <div class="absolute top-1/3 right-1/4 w-80 h-80 bg-gradient-to-br from-purple-400/8 to-pink-400/6 rounded-full blur-3xl animate-pulse"
                        style="animation-delay: 1s;"></div>
                    <div class="absolute bottom-1/4 left-1/3 w-72 h-72 bg-gradient-to-br from-emerald-400/6 to-cyan-400/8 rounded-full blur-3xl animate-pulse"
                        style="animation-delay: 2s;"></div>

                    <!-- Enhanced light mode grid -->
                    <div class="absolute inset-0 opacity-30"
                        style="background-image: linear-gradient(rgba(59,130,246,0.015) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.015) 1px, transparent 1px); background-size: 50px 50px;">
                    </div>
                </div>

                <!-- Dark Mode Background -->
                <div class="absolute inset-0 transition-opacity duration-300 dark-bg opacity-0" id="slide-dark">
                    <!-- Dark mode gradient orbs -->
                    <div
                        class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-blue-500/18 to-indigo-600/15 rounded-full blur-3xl animate-pulse">
                    </div>
                    <div class="absolute top-1/3 right-1/4 w-80 h-80 bg-gradient-to-br from-purple-500/15 to-pink-500/12 rounded-full blur-3xl animate-pulse"
                        style="animation-delay: 1s;"></div>
                    <div class="absolute bottom-1/4 left-1/3 w-72 h-72 bg-gradient-to-br from-emerald-400/8 to-cyan-500/10 rounded-full blur-3xl animate-pulse"
                        style="animation-delay: 2s;"></div>

                    <!-- Dark mode grid -->
                    <div class="absolute inset-0 opacity-20"
                        style="background-image: linear-gradient(rgba(139,92,246,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(139,92,246,0.02) 1px, transparent 1px); background-size: 50px 50px;">
                    </div>
                </div>
            </div>

            <!-- Header -->
            <livewire:navbar />

            <!-- Hero section -->
            <section
                class="px-6 py-8 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300 max-w-8xl mx-auto w-full flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="max-w-xl">
                    <h2 class="text-3xl font-extrabold  transition-colors duration-300">
                        Hai, {{ auth()->user()->name }} <span aria-label="raised hands" role="img">🙌</span>
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-lg transition-colors duration-300">Lacak
                        keuanganmu dengan mudah sekarang!
                        Kelola pemasukan
                        &
                        pengeluaran tanpa stres. Yuk, mulai lebih rapi hari ini!</p>
                    <div class="flex gap-4 flex-wrap transition-colors duration-300">
                        <button type="button" wire:click="openModal('income')"
                            class="dark:bg-green-800/30 bg-green-800 hover:bg-green-700 border border-green-500 cursor-pointer transition text-white font-semibold px-5 py-2 rounded-lg flex items-center gap-2 whitespace-nowrap">
                            Tambah Penghasilan <span aria-label="money with wings" role="img">🪙</span>
                        </button>
                        <button type="button" wire:click="openModal('expense')"
                            class="bg-expense dark:bg-red-800/30 bg-red-800 backdrop-blur-lg border border-red-500 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold transition-colors cursor-pointer">
                            Tambah Pengeluaran <span aria-label="worried face" role="img">🥵</span>
                        </button>
                    </div>
                </div>

                <aside
                    class="dark:bg-[#27272a] bg-[#f4f4f5] shadow-xl rounded-md p-3 text-gray-500 dark:text-gray-400 font-md max-w-lg italic select-none transition-colors duration-300">
                    <p><span aria-label="light bulb" role="img">💡</span> "Don't save the remaining money after
                        spending, but spend the remaining money after saving."</p>
                    <footer class="text-gray-500 dark:text-gray-400 mt-2 text-right font-light">– Warren Buffett
                    </footer>
                </aside>
            </section>

            <!-- Summary section -->
            <section class="px-5 py-8 max-w-8xl mx-auto w-full flex flex-col gap-6">
                <livewire:card-transaction />
            </section>

            {{-- Table --}}
            <div class="w-full ">
                <!-- Card Header -->
                <div class="px-6 py-2 space-y-4 relative">
                    <div class="flex flex-col items-start">
                        <div class="mb-5">
                           <div class="flex items-center gap-2 mb-2">
                                <div class="p-3 w-fit rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-theme hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-database-icon lucide-database h-5 w-5 text-white">
                                    <ellipse cx="12" cy="5" rx="9" ry="3" />
                                    <path d="M3 5V19A9 3 0 0 0 21 19V5" />
                                    <path d="M3 12A9 3 0 0 0 21 12" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Tabel Transaksi</h2>
                             </div>
                            <p class="text-[15px] text-gray-500 dark:text-gray-400 transition-colors duration-300">
                                Daftar semua transaksi keuangan</p>
                        </div>

                        <div class="flex flex-row w-full justify-between mb-2">
                            <div class="flex flex-row gap-3">
                                <button id="kategori-btn"
                                    class="items-center flex justify-center font-semibold text-sm cursor-pointer px-5 py-2 border-[1px] gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:transform hover:scale-105 rounded-lg hover:shadow-xl transition-all duration-400"
                                    title="Category">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        class="fill-gray-950 dark:fill-white transition-colors duration-300"
                                        viewBox="0 0 24 24">
                                        <path fill=""
                                            d="M5 11q-.825 0-1.412-.587T3 9V5q0-.825.588-1.412T5 3h4q.825 0 1.413.588T11 5v4q0 .825-.587 1.413T9 11zm0 10q-.825 0-1.412-.587T3 19v-4q0-.825.588-1.412T5 13h4q.825 0 1.413.588T11 15v4q0 .825-.587 1.413T9 21zm10-10q-.825 0-1.412-.587T13 9V5q0-.825.588-1.412T15 3h4q.825 0 1.413.588T21 5v4q0 .825-.587 1.413T19 11zm0 10q-.825 0-1.412-.587T13 19v-4q0-.825.588-1.412T15 13h4q.825 0 1.413.588T21 15v4q0 .825-.587 1.413T19 21z" />
                                    </svg>
                                    Kategory
                                </button>
                                <button id="type-button" data-dropdown-toggle="dropdownSearchType"
                                    class="items-center flex justify-center font-semibold text-sm cursor-pointer px-5 py-2 border-[1px] gap-2 bg-gradient-to-br from-white/10 to-white/5 hover:transform hover:scale-105 rounded-lg hover:shadow-xl transition-all duration-400"
                                    title="Tipe">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        class="fill-gray-950 dark:fill-white transition-colors duration-300"
                                        viewBox="0 0 24 24">
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
                                            class="fill-gray-950 dark:fill-white transition-colors duration-300"
                                            viewBox="0 0 24 24">
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
                                                    <input type="checkbox" id="checkbox-view-1"
                                                        class="sr-only peer text-start"
                                                        wire:click="toggleColumn('kategori')"
                                                        {{ !in_array('kategori', $hiddenColumns) ? 'checked' : '' }} />
                                                    <div
                                                        class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                                    </div>

                                                    <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200 opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7"></path>
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
                                                    <input type="checkbox" id="checkbox-view-2"
                                                        class="sr-only peer text-start"
                                                        wire:click="toggleColumn('deskripsi')"
                                                        {{ !in_array('deskripsi', $hiddenColumns) ? 'checked' : '' }} />
                                                    <div
                                                        class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                                    </div>

                                                    <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7"></path>
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
                                                    <input type="checkbox" id="checkbox-view-3"
                                                        class="sr-only peer text-start"
                                                        wire:click="toggleColumn('tanggal')"
                                                        {{ !in_array('tanggal', $hiddenColumns) ? 'checked' : '' }} />
                                                    <div
                                                        class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                                    </div>

                                                    <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7"></path>
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
                                                    <input type="checkbox" id="checkbox-view-4"
                                                        class="sr-only peer text-start"
                                                        wire:click="toggleColumn('tipe')"
                                                        {{ !in_array('tipe', $hiddenColumns) ? 'checked' : '' }} />
                                                    <div
                                                        class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                                    </div>

                                                    <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7"></path>
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
                                                    <input type="checkbox" id="checkbox-view-5"
                                                        class="sr-only peer text-start"
                                                        wire:click="toggleColumn('jumlah')"
                                                        {{ !in_array('jumlah', $hiddenColumns) ? 'checked' : '' }} />
                                                    <div
                                                        class="h-4 w-4 px-2 rounded-sm transition-all duration-200 peer-checked:bg-transparent peer-checked:border-transparent">
                                                    </div>

                                                    <svg class="absolute inset-0 h-full w-full text-gray-950 dark:text-gray-200  opacity-0 transition-all duration-200 peer-checked:opacity-100 peer-checked:transform peer-checked:scale-110"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7"></path>
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
                                            <th
                                                class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                                Kategori </th>
                                        @endunless
                                        @unless (in_array('deskripsi', $hiddenColumns))
                                            <th
                                                class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                                Deskripsi</th>
                                        @endunless
                                        @unless (in_array('tanggal', $hiddenColumns))
                                            <th
                                                class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                                Tanggal</th>
                                        @endunless
                                        @unless (in_array('tipe', $hiddenColumns))
                                            <th
                                                class="px-4 py-3 font-semibold text-left text-sm  text-gray-900 dark:text-[#f8fafc]">
                                                Tipe</th>
                                        @endunless
                                        @unless (in_array('jumlah', $hiddenColumns))
                                            <th
                                                class="px-4 py-3 font-semibold text-right text-sm  text-gray-900 dark:text-[#f8fafc]">
                                                Jumlah</th>
                                        @endunless

                                        <th
                                            class="px-4 py-3 text-center text-sm  text-gray-900 dark:text-[#f8fafc] w-[70px]">
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
