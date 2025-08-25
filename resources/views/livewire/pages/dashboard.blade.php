<div>
    <div class="flex h-screen">
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

        {{-- Modal --}}
        <div id="crud-modal" wire:click.self="closeModal" tabindex="-1" x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full  h-full md:inset-0 max-h-full bg-black/60">
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
                                    class="z-11 dark:bg-gray-950/70  absolute mt-[10px] rounded-lg shadow-sm w-60">
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
                                class="glass bg-gray-950/70 cursor-pointer flex-1 px-4 py-2 rounded-lg border border-border hover:bg-muted/50  hover:text-purple-400">
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
            class="fixed inset-0 z-12 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full h-full md:inset-0 max-h-full bg-black/75">
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

        {{-- Overlay --}}
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




        <!-- Main Content -->
        <main class="min-h-screen w-full lg:ml-72">
            <!-- Header -->
            <livewire:navbar />
            @if (session()->has('successD'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                    <div class="notification" id="notif">
                        <div class="notification-content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                viewBox="0 0 48 48">
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
            {{-- Content Main --}}
            <div class="px-5 pb-10">
                <section class="px-5 py-6  max-w-8xl mx-auto w-full flex flex-col items-center">
                    <div
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full glass border transition-all duration-300 hover:scale-105 hover:shadow-theme mb-4">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
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
                            <button type="button" wire:click="openModal('income')"
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
                            <button type="button" wire:click="openModal('expense')"
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
                    <livewire:card-transaction />
                </section>

                {{-- Table --}}
                <section class="w-full ">
                    <!-- Card Header -->
                    <div class="px-6 py-2 space-y-4 relative">
                        <div class="flex flex-col items-start">

                            <div class="mb-5">
                                <div class="flex items-center gap-2 mb-2">
                                    <div
                                        class="p-3 w-fit rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 shadow-theme hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
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
                                        <div role="menu" x-show="openCategory"
                                            @click.outside="openCategory = false"
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-100"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95" x-cloak=""
                                            class="origin-top-left glass absolute left-0 mt-2 w-40 rounded-md shadow-lg border border-gray-300 z-99">
                                            <div class="flex flex-col gap-2 items-center p-2 rounded-sm">
                                                @foreach ($categories as $category)
                                                    <button
                                                        class="flex  hover:bg-gray-100 dark:hover:bg-[#94A3B81A] w-full gap-2 items-center p-1 rounded-md  cursor-pointer">
                                                        <input id="category-{{ $category->category }}"
                                                            wire:model.live="filter_category"
                                                            wire:key="category-checkbox-{{ $category->category }}"
                                                            value="{{ $category->category }}" type="checkbox"
                                                            class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                                        <label for="category-{{ $category->category }}"
                                                            class=" text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">{{ $category->category }}</label>
                                                    </button>
                                                @endforeach
                                                <template
                                                    x-if="typeof $wire.filter_category !== 'undefined' && $wire.filter_category.length > 0">
                                                    <button @click="$wire.filter_category = []" value="clear"
                                                        wire:click="clearFilter"
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
                                                    <input id="checkbox-item-1" type="checkbox"
                                                        wire:model.live="filter_types" value="income"
                                                        class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                                    <label for="checkbox-item-1"
                                                        class=" text-sm flex gap-2 text-center items-center font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-trending-up-icon lucide-trending-up h-4 w-4 text-green-400">
                                                            <path d="M16 7h6v6" />
                                                            <path d="m22 7-8.5 8.5-5-5L2 17" />
                                                        </svg>

                                                        Income</label>
                                                </button>
                                                <button
                                                    class="flex  hover:bg-gray-100 dark:hover:bg-[#94A3B81A] w-full gap-2 items-center p-1 rounded-md  cursor-pointer">
                                                    <input id="checkbox-item-2" type="checkbox"
                                                        wire:model.live="filter_types" value="expense"
                                                        class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="checkbox-item-2"
                                                        class=" text-sm flex gap-2 text-center items-center font-medium text-gray-900 rounded-sm dark:text-gray-300 cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-trending-down-icon lucide-trending-down h-4 w-4 text-red-400">
                                                            <path d="M16 17h6v-6" />
                                                            <path d="m22 17-8.5-8.5-5 5L2 7" />
                                                        </svg>

                                                        Expense</label>
                                                </button>
                                                <template
                                                    x-if="typeof $wire.filter_types !== 'undefined' && $wire.filter_types.length > 0">
                                                    <button @click="$wire.filter_types = []" value="clear"
                                                        wire:click="clearFilter"
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
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
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
                                    <tbody
                                        id="transaction-tbody"class="divide-y divide-gray-200 dark:divide-gray-700 ">
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
                                                        <svg class="h-4 w-4 mx-auto" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
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
                        <div id="crud-modal" wire:click.self="closeModalDelete" tabindex="-1"
                            x-data="{ show: @entangle('showModalDelete') }" x-show="show" x-cloak x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" wire:loading.remove wire:target="deleteTransaction"
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
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>

                                <div class="flex gap-5 pt-4 py-5 w-fit mx-auto">
                                    <button type="submit" wire:click="deleteTransaction"
                                        class="text-white inline-flex items-center cursor-pointer bg-gradient-to-r from-red-500 to-pink-500 border-0 shadow-lg font-medium rounded-lg text-md px-4 py-1 text-center">

                                        <span>
                                            Delete
                                        </span>
                                        {{-- <span wire:loading wire:click="deleteTransaction()">
                                            <div role="status">
                                                <svg aria-hidden="true"
                                                    class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-white"
                                                    viewBox="0 0 100 101" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentFill" />
                                                </svg>
                                            </div>
                                        </span> --}}
                                    </button>
                                    <button type="button"wire:click="closeModalDelete"
                                        class="glass bg-gray-950/70 cursor-pointer flex-1 px-4 py-2 rounded-lg border border-border hover:bg-muted/50  hover:text-purple-400">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="flex-col sm:flex-row w-full pt-2 border-gray-200 dark:border-gray-700 mt-2">
                            {{ $transactions->links(data: ['scrollTo' => false]) }}
                        </div>

                    </div>
                </section>

                <section class="px-5">
                    @livewire('transaction-chart')
                </section>


                {{-- Footer --}}
                <div class="mt-16 text-center">
                    <div
                        class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium shadow-theme-lg hover:shadow-xl transition-all duration-300 cursor-pointer hover:scale-105 btn-premium group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-sparkles-icon lucide-sparkles h-5 w-5 group-hover:rotate-12 transition-transform duration-300">
                            <path
                                d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                            <path d="M20 2v4" />
                            <path d="M22 4h-4" />
                            <circle cx="4" cy="20" r="2" />
                        </svg>
                        <span>Upgrade to Pro for Advanced AI Features</span>
                        <div class="w-2 h-2 bg-white/40 rounded-full animate-pulse"> </div>
                    </div>
                    <p class="text-sm text-muted-foreground mt-4 max-w-md mx-auto">
                        Unlock premium features and get personalized financial insights powered by Laravel Livewire
                    </p>
                </div>

            </div>


        </main>
    </div>

  
</div>
