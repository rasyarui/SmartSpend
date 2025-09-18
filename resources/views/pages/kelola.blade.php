<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Money Tracking App</title>

    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #4b5563;
            /* Tailwind slate-600 */
            border-radius: 3px;
        }
    </style>

    <style>
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.4s ease-out;
        }

        .animate-pulse-gentle {
            animation: pulse 0.3s ease-in-out;
        }

        .number-glow {
            text-shadow: 0 0 10px rgba(139, 92, 246, 0.3);
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
    @livewireStyles

</head>

<body class="dark:text-white text text-black font-sans ">


    <div class="background-slider fixed inset-0 pointer-events-none transition-all duration-300" id="background-slider"
        wire:ignore>
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

        <div class="absolute inset-0">
            <div
                class="absolute top-1/4 left-1/4 w-1 h-1 bg-blue-400 rounded-full animate-ping opacity-30 animation-delay-0">
            </div>
            <div
                class="absolute top-1/3 right-1/3 w-1 h-1 bg-purple-400 rounded-full animate-ping opacity-30 animation-delay-1000">
            </div>
            <div
                class="absolute bottom-1/3 left-1/2 w-1 h-1 bg-pink-400 rounded-full animate-ping opacity-30 animation-delay-2000">
            </div>
        </div>
    </div>

    <livewire:pages.kelola/>

    @livewireScripts

    @stack('scripts')


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <script src="/js/index.js"></script>
    <script src="/js/darkMode.js"></script>


</body>

</html>
