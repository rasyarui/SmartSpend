<div>
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
                                        type="text" wire:model="transaction_date"
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
</div>
