<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Register</title>
    {{-- <link href="./dist/output.css" rel="stylesheet"> --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <link rel="stylesheet" href="/css/style.css">
    {{-- @vite('resources/js/app.js') --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  


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


<body class="min-h-screen bg-background text-foreground ">


    <div class="fixed inset-0 pointer-events-none transition-all duration-700">
        <!-- Light Mode Background -->
        <div class="absolute inset-0 transition-opacity duration-700 dark:opacity-0" id="light-bg">
            <div
                class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-blue-400/15 to-indigo-400/10 rounded-full blur-3xl animate-pulse animation-delay-0">
            </div>
            <div
                class="absolute top-1/3 right-1/4 w-80 h-80 bg-gradient-to-br from-purple-400/10 to-pink-400/8 rounded-full blur-3xl animate-pulse animation-delay-1000">
            </div>
            <div
                class="absolute bottom-1/4 left-1/3 w-72 h-72 bg-gradient-to-br from-emerald-400/8 to-cyan-400/10 rounded-full blur-3xl animate-pulse animation-delay-2000">
            </div>
            <div
                class="absolute inset-0 bg-[linear-gradient(rgba(59,130,246,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(59,130,246,0.02)_1px,transparent_1px)] bg-[size:50px_50px]">
            </div>
        </div>

        <!-- Dark Mode Background -->
        <div class="absolute inset-0 transition-opacity duration-700 opacity-0 dark:opacity-100" id="dark-bg">
            <div
                class="absolute top-0 left-1/4 w-96 h-96 bg-gradient-to-br from-blue-500/20 to-indigo-600/18 rounded-full blur-3xl animate-pulse animation-delay-0">
            </div>
            <div
                class="absolute top-1/3 right-1/4 w-80 h-80 bg-gradient-to-br from-purple-500/18 to-pink-500/15 rounded-full blur-3xl animate-pulse animation-delay-1000">
            </div>
            <div
                class="absolute bottom-1/4 left-1/3 w-72 h-72 bg-gradient-to-br from-emerald-400/10 to-cyan-500/12 rounded-full blur-3xl animate-pulse animation-delay-2000">
            </div>
            <div
                class="absolute inset-0 bg-[linear-gradient(rgba(139,92,246,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(139,92,246,0.03)_1px,transparent_1px)] bg-[size:50px_50px]">
            </div>
        </div>

        <!-- Floating particles -->
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


    <livewire:auth.register />


    <script src="/js/index.js"></script>
    <script src="/js/darkMode.js"></script>


    @livewireScripts

</body>

</html>
