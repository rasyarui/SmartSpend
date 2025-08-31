<div>
    <div class="flex h-screen">

        <div id="crud-modal" wire:click.self="closeModal" tabindex="-1" x-data="{ show: @entangle('showModal') }" x-show="show" x-cloak
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full h-full md:inset-0 max-h-full bg-black/60">
            <div class="flex items-center justify-center p-4">
                <!-- Modal content -->
                <div
                    class="glass border borde-border dark:border-gray-600 bg-gray-950/70 rounded-lg w-135 max-w-md transform transition-all duration-300 scale-95">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <div class="p-2 mr-3 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-target-icon lucide-target">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="6" />
                                <circle cx="12" cy="12" r="2" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white ">
                                Tambah Goal
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                Buat goal kamu
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
                    <form class="p-4 md:p-5" wire:submit.prevent="createTabungan">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Nama
                                    Goal</label>
                                <input type="text" name="name" id="name" wire:model="name"
                                    class="glass border border-gray-300 outline-none text-gray-900 text-sm font-medium rounded-lg block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-500 dark:text-white "
                                    placeholder="e.g, Liburan, Nikah">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="target_amount"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Target</label>
                                <input type="number" name="target_amount" id="target_amount" wire:model="target_amount"
                                    class="glass border border-gray-300 outline-none text-gray-900 text-sm font-medium rounded-lg block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-500 dark:text-white "
                                    placeholder="Rp 0">
                                @error('target_amount')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="category"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Category</label>
                                <input type="text" name="category" id="category" wire:model="category"
                                    class="glass border border-gray-300 outline-none text-gray-900 text-sm font-medium rounded-lg block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-500 dark:text-white "
                                    placeholder="e.g, Emergency, Travel">
                                @error('category')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-2" wire:ignore.self>
                                <label for="deadline"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Deadline</label>
                                <div class="relative ">
                                    <input id="datepicker-actions" datepicker datepicker-format="yyyy-mm-dd"
                                       wire:model="deadline" type="text" autocomplete="off"
                                        {{-- value="{{ \Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, d M Y') }}" --}}
                                        class="glass border border-border outline-none border-gray-300 text-gray-900 text-sm font-medium rounded-lg block w-full ps-10 p-2.5 dark:placeholder-gray-500 placeholder:text-gray-900 dark:text-white"
                                        placeholder="Deadline date">
                                    @error('deadline')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray/50 dark:text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <label for="priority"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Priority</label>
                                <select name="priority" id="priority" wire:model="priority"
                                    class="w-full px-3 py-2 rounded-lg glass border bg-background text-foreground focus:ring-2 focus:ring-purple-500">
                                    <option value="low">Low Priority</option>
                                    <option value="medium">Medium Priority</option>
                                    <option value="high">High Priority</option>
                                </select>
                                @error('priority')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label for="description"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Description</label>
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
                                class="text-white inline-flex items-center cursor-pointer bg-green-500 hover:bg-green-600 font-medium rounded-lg text-md px-4 py-1 text-center">
                                <div class="p-1 mr-1 rounded-lg" wire:loading.remove wire:target="createTabungan">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-trending-up-icon lucide-trending-up">
                                        <path d="M16 7h6v6" />
                                        <path d="m22 7-8.5 8.5-5-5L2 17" />
                                    </svg>
                                </div>


                                <span wire:loading.remove wire:target="createTabungan">
                                    Tambang Goals
                                </span>
                                <span wire:loading wire:target="createTabungan">
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


        <div id="deposit-modal" wire:click.self="closeModal" tabindex="-1" x-data="{ show: @entangle('showModalDeposit') }" x-show="show"
            x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full h-full md:inset-0 max-h-full bg-black/60">
            <div class="flex items-center justify-center p-4">
                <!-- Modal content -->
                <div
                    class="glass border borde-border dark:border-gray-600 bg-gray-950/70 rounded-lg w-135 max-w-md transform transition-all duration-300 scale-95">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <div class="p-2 mr-3 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-target-icon lucide-target">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="6" />
                                <circle cx="12" cy="12" r="2" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white ">
                                @if ($selectedGoal)
                                    Deposit to {{ $selectedGoal->name }}
                                @endif
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                Deposit untuk mencapai tujuan
                            </p>
                        </div>

                        <button type="button"wire:click="closeModal"
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
                    <form class="p-4 md:p-5" wire:submit.prevent="deposit">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="amount"
                                    class="block mb-2 text-md font-bold text-gray-900 dark:text-white">Jumlah</label>
                                <input type="number" name="amount" id="amount" wire:model="amount"
                                    class="glass border border-gray-300 outline-none text-gray-900 text-sm font-medium rounded-lg block w-full p-2.5 dark:border-gray-500 dark:placeholder-gray-500 dark:text-white "
                                    placeholder="Rp 20.000.000">
                                @error('amount')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex gap-2 pt-4">
                            <button type="button"wire:click="closeModal"
                                class="glass bg-gray-950/70 cursor-pointer flex-1 px-4 py-2 rounded-lg border border-border hover:bg-muted/50  hover:text-purple-400">
                                Cancel
                            </button>
                            <button type="submit" wire:loading.attr="disabled"
                                class="text-white inline-flex items-center cursor-pointer bg-green-500 hover:bg-green-600 font-medium rounded-lg text-md px-4 py-1 text-center">
                                <div class="p-1 mr-1 rounded-lg" wire:loading.remove wire:target="deposit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-trending-up-icon lucide-trending-up">
                                        <path d="M16 7h6v6" />
                                        <path d="m22 7-8.5 8.5-5-5L2 17" />
                                    </svg>
                                </div>
                                <span wire:loading.remove wire:target="deposit">
                                    Tambang Goals
                                </span>
                                <span wire:loading wire:target="deposit">
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

                        </div>

                    </form>
                </div>
            </div>
        </div>


        <div id="crud-modal" wire:click.self="closeModal" tabindex="-1" x-data="{ show: @entangle('showModalDelete') }" x-show="show"
            x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
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
                            Apakah anda yakin ingin menghapus @if ($selectedGoal)
                                Deposit to {{ $selectedGoal->name }}
                            @endif
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

        <x-sidebar></x-sidebar>

        <main class="min-h-screen w-full lg:ml-72">


            <livewire:components.navbar />

            <div class="px-5 py-5 space-y-6 pb-10">
                {{-- Header --}}
                <section class="px-5 space-y-10 max-w-8xl mx-auto w-full flex flex-col">
                    {{-- Savings --}}
                    <div class="space-y-2 flex gap-5 items-start flex-col sm:flex-row justify-between sm:items-center">
                        <div class="left flex flex-col">
                            <div class="flex items-center gap-3 mb-2">
                                <div
                                    class="p-3 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 shadow-theme hover:shadow-theme-lg transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-piggy-bank-icon lucide-piggy-bank h-8 w-8">
                                        <path
                                            d="M11 17h3v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-3a3.16 3.16 0 0 0 2-2h1a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-1a5 5 0 0 0-2-4V3a4 4 0 0 0-3.2 1.6l-.3.4H11a6 6 0 0 0-6 6v1a5 5 0 0 0 2 4v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1z" />
                                        <path d="M16 10h.01" />
                                        <path d="M2 8v1a2 2 0 0 0 2 2h1" />
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold gradient-text">
                                        My Savings Goals
                                    </h1>
                                    <p class="text-muted-foreground">
                                        Track your savings progress and achieve your financial goals with AI insights
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center gap-2 px-3 py-2 rounded-full glass border">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-trophy-icon lucide-trophy h-4 w-4 text-yellow-500">
                                        <path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978" />
                                        <path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978" />
                                        <path d="M18 9h1.5a1 1 0 0 0 0-5H18" />
                                        <path d="M4 22h16" />
                                        <path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z" />
                                        <path d="M6 9H4.5a1 1 0 0 1 0-5H6" />
                                    </svg>
                                    <span class="font-medium">{{ $completedCount }} Goals Completed</span>
                                </div>
                                <div class="flex items-center gap-2 px-3 py-2 rounded-full glass border">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-target-icon lucide-target h-4 w-4 text-blue-500">
                                        <circle cx="12" cy="12" r="10" />
                                        <circle cx="12" cy="12" r="6" />
                                        <circle cx="12" cy="12" r="2" />
                                    </svg>
                                    <span class="font-medium">{{ $isProgressCount }} Active Goals</span>
                                </div>
                                <div class="flex items-center gap-2 px-3 py-2 rounded-full glass border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-sparkles-icon lucide-sparkles h-4 w-4 text-purple-500">
                                        <path
                                            d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                                        <path d="M20 2v4" />
                                        <path d="M22 4h-4" />
                                        <circle cx="4" cy="20" r="2" />
                                    </svg>
                                    <span class="font-medium">Overall Progress</span>
                                </div>
                            </div>
                        </div>

                        <div class="right">
                            <button type="button" wire:click="openModal"
                                class="bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 gap-3 w-full text-center justify-center shadow-theme-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group relative cursor-pointer  text-white font-semibold px-5 py-2 rounded-lg flex items-center">
                                <div
                                    class="p-2 rounded-xl bg-white/20 shadow-theme group-hover:shadow-theme-lg transition-all duration-300 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus h-5 w-5">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <h3 class="text-md font-bold">Create New Goal</h3>
                                </div>
                            </button>
                        </div>
                    </div>
                </section>

                {{-- Card Overall --}}
                <section class="px-5 space-y-10 max-w-8xl mx-auto w-full flex flex-col">
                    <div class="glass rounded-3xl border hover-lift transition-all duration-300 ">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="p-4 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 shadow-theme">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="lucide lucide-piggy-bank-icon lucide-piggy-bank h-8 w-8 text-white">
                                            <path
                                                d="M11 17h3v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-3a3.16 3.16 0 0 0 2-2h1a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-1a5 5 0 0 0-2-4V3a4 4 0 0 0-3.2 1.6l-.3.4H11a6 6 0 0 0-6 6v1a5 5 0 0 0 2 4v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1z" />
                                            <path d="M16 10h.01" />
                                            <path d="M2 8v1a2 2 0 0 0 2 2h1" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold">Progress Tabungan Keseluruhan</h3>
                                        <p class="text-gray-400">Perjalanan Anda menuju kebebasan finansial</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-3xl font-bold gradient-text">Rp
                                        {{ number_format($stats['total_current']) }}</h3>
                                    <h3 class="text-sm font-bold text-gray-400">Rp
                                        {{ number_format($stats['total_target']) }}</h3>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span>Keseluruhan Proses</span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-400">80%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-border">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-500">{{ $completedCount }}</div>
                                    <div class="text-sm text-muted-foreground">Completed</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-500">{{ $isProgressCount }}</div>
                                    <div class="text-sm text-muted-foreground">Dalam Proses</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold gradient-text">{{ $stats['total_data'] }}</div>
                                    <div class="text-sm text-muted-foreground">Total Goals</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Card Tabungan --}}
                <section class="px-5 space-y-10 max-w-8xl mx-auto w-full flex flex-col">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @forelse ($goals as $goal)
                            <div
                                class="card glass border hover-lift transition-all duration-300 group relative overflow-hidden p-5 rounded-2xl space-y-12">
                                <div class="card-header pb-3">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center gap-3">
                                            <div>
                                                <h3 class="text-lg flex items-center gap-2 capitalize">
                                                    {{ $goal->name }}</h3>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <div
                                                        class="bg-gradient-to-r text-xs rounded-lg px-2 py-1 from-purple-500 to-pink-500 text-white border-0 capitalize">
                                                        {{ $goal->category }}
                                                    </div>
                                                    <div
                                                        class="text-xs px-2 py-1 rounded-lg {{ $goal->priorityColor }}">
                                                        <span class="ml-1 capitalize">{{ $goal->priority }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($goal->daysRemainingBadge)
                                            <div class="text-right">
                                                <p
                                                    class="tex-sm font-semibold 
                                                    {{ $goal->daysRemainingBadge->color }}">
                                                    {{ $goal->daysRemainingBadge->label }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $goal->deadline->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="space-y-12">

                                    <div class="flex justify-between mb-1">
                                        @if ($goal->isCompleted)
                                            <span
                                                class="text-base font-medium {{ $goal->daysRemainingBadge->color }}">{{ $goal->daysRemainingBadge->label }}</span>
                                        @else
                                            <span
                                                class="text-base font-medium text-blue-700 dark:text-white">Progress</span>
                                            <span
                                                class="text-sm font-medium text-blue-700 dark:text-white">{{ $goal->progress }}%</span>
                                        @endif
                                    </div>
                                    <div class="w-full glass rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-gradient-to-r from-pink-500 to-purple-600 h-2.5 rounded-full"
                                            style="width: {{ $goal->progress }}%"></div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-muted-foreground">Current</p>
                                            <p class="font-semibold text-green-500">Rp
                                                {{ number_format($goal->current_amount) }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-muted-foreground">Target</p>
                                            <p class="font-semibold">Rp {{ number_format($goal->target_amount) }}</p>
                                        </div>
                                    </div>

                                    <div class="flex gap-2.5 pt-2">
                                        @if ($goal->isCompleted)
                                            <button
                                                class="flex bg-gradient-to-r from-green-500 to-teal-600 hover:opacity-90 px-3 py-1 w-full items-center justify-center rounded-lg text-white transition-all duration-300 hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-circle-check-icon lucide-circle-check h-4 w-4 mr-2">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <path d="m9 12 2 2 4-4" />
                                                </svg>
                                                Target Sudah Selesai
                                            </button>
                                        @else
                                            <button wire:click="openModalDeposit({{ $goal->id }})"
                                                class="flex bg-gradient-to-r from-purple-500 to-pink-600 hover:opacity-90 px-3 py-1 w-full items-center justify-center rounded-lg text-white transition-all duration-300 hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-coins-icon lucide-coins h-4 w-4 mr-2">
                                                    <circle cx="8" cy="8" r="6" />
                                                    <path d="M18.09 10.37A6 6 0 1 1 10.34 18" />
                                                    <path d="M7 6h1v4" />
                                                    <path d="m16.71 13.88.7.71-2.82 2.82" />
                                                </svg>
                                                Deposit
                                            </button>
                                        @endif

                                        <button class="glass border hover:bg-muted rounded-lg flex-1 px-3 py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-pencil-icon lucide-pencil h-4 w-4">
                                                <path
                                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                                <path d="m15 5 4 4" />
                                            </svg>
                                        </button>
                                        <button class="glass border hover:bg-muted rounded-lg flex-1 px-3 py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                wire:click="openModalDelete({{ $goal->id }})" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="lucide lucide-trash2-icon lucide-trash-2 h-4 w-4 text-red-500">
                                                <path d="M10 11v6" />
                                                <path d="M14 11v6" />
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div
                                class="text-center w-full card glass border hover-lift transition-all duration-300 group relative overflow-hidden p-5 rounded-2xl space-y-12 ">
                                Tidak ada goals.
                            </div>
                        @endforelse
                    </div>
                </section>

            </div>
        </main>
    </div>
</div>
