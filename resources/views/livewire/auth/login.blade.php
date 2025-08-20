<div>
    <div class=" flex flex-col mx-autorounded-lg pt-5 my-5 ">

        <div class="flex justify-center items-center w-full h-full py-8 xl:gap-14 lg:justify-normal md:gap-5 draggable ">
            <div
                class="glass flex w-lg gap items-center border-border mx-auto mt-5 rounded-2xl p-8 flex-col hover:scale-[1.02] backdrop-blur-xl shadow-theme-lg hover:shadow-xl transition-all duration-300">
                <img src="/img/SmartSpend.png" alt="" width="100px" class="cursor-pointer">
                <div class="flex flex-col w-full h-full pb-6 text-center rounded-3xl mt-5">
                    <h3 class="text-3xl font-bold mb-3 gradient-text">Login</h3>
                    <p class="mb-3 text-muted-foreground leading-relaxed">Sign in to your FinanceAI account and continue
                        your intelligent financial journey</p>
                    <button id="github-login-btn" type="button"
                        class="w-full h-12 bg-gradient-to-r  cursor-pointer from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 dark:from-gray-100 dark:to-gray-200 dark:hover:from-gray-200 dark:hover:to-gray-300 text-white dark:text-gray-900 border-0 shadow-theme hover:shadow-theme-lg transition-all duration-300 hover:scale-105 group relative overflow-hidden rounded-lg">
                        <div class="flex items-center justify-center gap-3 relative z-10">
                            <div id="github-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-github-icon lucide-github">
                                    <path
                                        d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4" />
                                    <path d="M9 18c-4.51 2-5-2-7-2" />
                                </svg>
                            </div>
                            <span class="font-medium" id="github-text">Continue with GitHub</span>
                        </div>
                    </button>
                    <div class="relative my-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-border"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <div class="px-4 glass rounded-full border border-border/50">
                                <span class="text-xs text-aca font-medium">or continue with email</span>
                            </div>
                        </div>
                    </div>
                    @if ($message)
                        <div
                            class="mb-4 px-4 py-3 rounded {{ $messageType === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
                            {{ $message }}
                        </div>
                    @endif
                    <form class="flex flex-col" wire:submit="login">
                        <div class="space-y-1 mb-7">
                            <label for="email" class="text-sm font-medium flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-mail-icon lucide-mail text-blue-700">
                                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                </svg>
                                Email Address
                            </label>
                            <input id="email" type="email" name="email" wire:model.live="email"
                                placeholder="Enter your email address"
                                class="w-full h-12 px-4 border border-border glass bg-input text-lg rounded-lg transition-all duration-300 focus:scale-[1.02] focus:shadow-theme focus:border-blue-500 focus:outline-none"
                                required value="{{ old('email') }}" />
                            @error('email')
                                <span class="error">{{ $message }}</span>
                                {{-- <div class="text-red-400 text-sm hidden" id="email-error"></div> --}}
                            @enderror

                        </div>
                        <button type="submit" id="submit-btn"
                            class="w-full h-12 mb-5 cursor-pointer bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white border-0 shadow-theme hover:shadow-theme-lg transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none group relative overflow-hidden rounded-lg">
                            <div class="flex items-center justify-center gap-3 relative z-10">
                                <label for="email" class="text-sm font-medium flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-mail-icon lucide-mail">
                                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                        <rect x="2" y="4" width="20" height="16" rx="2" />
                                    </svg>
                                </label>
                                <span class="font-medium" id="submit-text" wire:loading.remove wire:target="login">Sign
                                    in with Email </span>
                                <span class="font-medium" wire:loading wire:target="login">Memproses...</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-arrow-right-icon lucide-arrow-right">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </div>
                        </button>

                        <div class="text-center">
                            <p class="text-sm text-aca">
                                Don't have an account?
                                <a href="/register"
                                    class="font-medium  text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-300 hover:underline inline-flex items-center gap-1 group ml-1">
                                    Create account
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-sparkles-icon lucide-sparkles group-hover:rotate-12 transition-transform duration-300">
                                        <path
                                            d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                                        <path d="M20 2v4" />
                                        <path d="M22 4h-4" />
                                        <circle cx="4" cy="20" r="2" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
