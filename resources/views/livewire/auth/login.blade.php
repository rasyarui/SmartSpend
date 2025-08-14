<div>
    <div class="container flex flex-col mx-auto bg-white rounded-lg pt-5 my-5">

        <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
            <div class="flex items-center justify-center w-full lg:p-12">
                <div class="flex items-center xl:p-5 flex-col">
                    <img src="/img/SmartSpend.png" alt="" width="100px" class="cursor-pointer">
                    <div class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl mt-5">
                        <h3 class="mb-3  text-3xl font-extrabold text-dark-grey-900">Login</h3>
                        <p class="mb-3 text-grey-700">to continue to SmartSpend</p>
                        <button>
                            <a
                                class="flex items-center justify-center w-full py-4 mb-6 text-sm font-medium transition duration-300 rounded-2xl text-grey-900 bg-grey-300 hover:bg-grey-400 focus:ring-4 focus:ring-grey-300">
                                <img class="h-5 mr-2"
                                    src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/logos/logo-google.png">
                                login in with Google
                            </a>
                        </button>
                        <div class="flex items-center mb-3">
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                            <p class="mx-4 text-grey-600">or</p>
                            <hr class="h-0 border-b border-solid border-grey-500 grow">
                        </div>
                        @if ($message)
                            <div
                                class="mb-4 px-4 py-3 rounded {{ $messageType === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
                                {{ $message }}
                            </div>
                        @endif
                        <form class="flex flex-col" wire:submit="login">
                            <div class="flex flex-col mb-7">
                                <label for="email" class="mb-2 text-sm text-start text-grey-900">Email*</label>
                                <input id="email" type="email" name="email" wire:model.live="email"
                                    placeholder="mail@loopple.com" required
                                    class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none focus:bg-grey-400  placeholder:text-grey-700 bg-grey-200 text-dark-grey-900 rounded-2xl" />
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button
                                class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-2xl hover:bg-purple-blue-600 focus:ring-4 focus:ring-purple-blue-100 bg-purple-blue-500"
                                wire:loading.attr="disabled"> <span wire:loading.remove wire:target="login">Masuk</span>
                                <span wire:loading wire:target="login">Memproses...</span></button>

                            <p class="text-sm leading-relaxed text-grey-900">Dont have account? <a href="/register"
                                    class="font-bold text-grey-700">Create an account</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
