<div>
    <div class="flex h-screen">
        <x-sidebar></x-sidebar>


        <main class="min-h-screen w-full lg:ml-72">
            <livewire:components.navbar />


            <div class="w-full text-center py-10 space-y-2">
                <h3 class="gradient-text text-2xl font-bold">Account Setting</h3>
                <p class="text-[#A3A3A3]">Manage your account preferences and security settings</p>
            </div>

            <main class="profile px-5 space-y-10 max-w-8xl mx-auto w-full flex flex-col">
                <div class="glass w-fulll rounded-xl h-100">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                </div>
            </main>
        </main>
    </div>
</div>
