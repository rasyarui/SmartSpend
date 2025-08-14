<div>

    <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <div class="mx-auto h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h2 class="mt-3 text-3xl font-extrabold text-gray-900">Verifikasi OTP</h2>
                <div class="mt-2 text-sm text-gray-600 justify-items-center w-ful">
                    <p> Masukkan kode 6 digit yang telah dikirim ke</p>
                    <div class="flex gap-2">
                        <span class="font-medium text-blue-600">{{ $user->email }}</span>
                        <button wire:click="openEditEmailModal" class="" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19.07 13.88L13 19.94V22h2.06l6.06-6.07m1.58-2.35l-1.28-1.28a.52.52 0 0 0-.38-.17c-.15.01-.29.06-.39.17l-1 1l2.05 2l1-1c.19-.2.19-.52 0-.72M11 18H4V8l8 5l8-5v2h2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7zm9-12l-8 5l-8-5z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="crud-modal" tabindex="-1" aria-hidden="true" x-data="{ show: @entangle('showEditEmailModal') }" x-show="show" x-cloak
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 overflow-y-auto overflow-x-hidden flex justify-center items-center w-full h-full md:inset-0 max-h-full bg-gray-500 bg-opacity-75">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 p-[20px]">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Edit Email
                                </h3>
                                <button type="button"wire:click="closeEditEmailModal"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4 md:p-5" wire:submit.prevent="updateEmailAndResendOtp">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email" id="email" wire:model.live="email"
                                            wire:model.defer="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Input new email" required="">
                                    </div>
                                </div>
                                <div></div>
                                <button type="submit" wire:loading.attr="disabled"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                    <span wire:loading.remove wire:target="updateEmailAndResendOtp">Update Email</span>
                                    <span wire:loading
                                        wire:target="updateEmailAndResendOtp">Memproses...</span></button>
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-8">
                <!-- Message Alert -->
                @if ($message)
                    <div
                        class="mb-4 px-4 py-3 rounded {{ $messageType === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
                        {{ $message }}
                    </div>
                @endif

                @if (session('info'))
                    <div class="mb-4 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded"
                        x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                        {{ session('info') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                        {{ session('warning') }}
                    </div>
                @endif



                <!-- Timer Display -->
                <div class="text-center mb-6">
                    @if (!$isExpired && $timeLeft > 0)
                        <div class="text-sm text-gray-600" wire:poll.1s="calculateTimeLeft">
                            Kode akan kedaluwarsa dalam:
                            <span class="font-bold text-red-600">
                                {{ gmdate('i:s', $timeLeft) }}
                            </span>
                        </div>
                    @elseif($isExpired)
                        <div class="text-sm text-red-600 font-medium">
                            Kode OTP telah kedaluwarsa
                        </div>
                    @endif
                </div>


                <form wire:submit.prevent ="verifyOtp">
                    <div class="mb-6">
                        <label for="otp_code" class="sr-only">Kode OTP</label>
                        <input type="text" id="otp_code" wire:model.live="otp_code" maxlength="6"
                            pattern="[0-9]{6}"
                            class="w-full px-4 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center text-3xl tracking-widest font-bold {{ $isExpired ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                            placeholder="000000" {{ $isExpired ? 'disabled' : '' }} autocomplete="one-time-code"
                            inputmode="numeric">

                        @error('otp_code')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                        {{ $isExpired || strlen($otp_code) !== 6 ? 'disabled' : '' }}>

                        <div wire:loading wire:target="verifyOtp" class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Memverifikasi...
                        </div>
                        <span wire:loading.remove wire:target="verifyOtp">
                            Verifikasi
                        </span>
                    </button>
                </form>

                <!-- Resend OTP Button -->
                <div class="mt-6">
                    <button wire:click="resendOtp"
                        class="w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
                        {{ $isResending ? 'disabled' : '' }}>

                        <div wire:loading wire:target="resendOtp" class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-700"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Mengirim...
                        </div>
                        <span wire:loading.remove wire:target="resendOtp">
                            Kirim Ulang OTP
                        </span>
                    </button>
                </div>

                <!-- Help Text -->
                <div class="mt-4 text-center">
                    <p class="text-xs text-gray-500">
                        Tidak menerima kode? Periksa folder spam atau
                        <button wire:click="resendOtp" class="text-blue-600 hover:text-blue-800 underline">
                            kirim ulang
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // Auto-focus on OTP input
            document.getElementById('otp_code').focus();

            // Listen for clear message event
            Livewire.on('clearMessage', () => {
                setTimeout(() => {
                    @this.clearMessage();
                }, 5000);
            });
        });
    </script>
</div>
