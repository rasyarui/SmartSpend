<div>
    <div class="container flex flex-col mx-auto bg-white rounded-lg">
        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-5 flex-col">
                    <img src="/img/SmartSpend.png" alt="" width="100px" class="cursor-pointer">
                    <div class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl mt-5">
                        <h3 class="mb-3  text-3xl font-extrabold text-dark-grey-900">Create your account</h3>
                        <p class="mb-3 text-grey-700">to continue to SmartSpend</p>
                        <form class="flex flex-col" wire:submit.prevent="register">
                            <div class="flex flex-col mb-5">
                                <label for="name" class="mb-2 text-sm text-start text-grey-900">Name</label>
                                <input id="name" type="name" name="name" wire:model.live="name"
                                    placeholder="name" required
                                    class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400  placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col mb-5">
                                <label for="email" class="mb-2 text-sm text-start text-grey-900">Email</label>
                                <input id="email" type="email" name="email" wire:model.live="email"
                                    placeholder="mail@loopple.com" required
                                    class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400  placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col mb-5">
                                <label for="password" class="mb-2 text-sm text-start text-grey-900">Password</label>
                                <input id="password" type="password" name="password" wire:model.live="password"
                                    placeholder="password" required
                                    class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400  placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-row justify-between mb-2">
                                <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                    <input type="checkbox" checked value="" class="sr-only peer">
                                </label>
                            </div>
                            <button
                                class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-2xl hover:bg-purple-blue-600 focus:ring-4 focus:ring-purple-blue-100 bg-purple-blue-500"
                                wire:loading.attr="disabled"> <span wire:loading.remove wire:target="register">Sign in</span>
                                <span wire:loading wire:target="register">Memproses...</span></button>
                            <p class="text-sm leading-relaxed text-grey-900">Already have account? <a href="/login"
                                    class="font-bold text-grey-700">Login</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
