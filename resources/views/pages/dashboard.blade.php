<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Money Tracking App</title>
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

<body class="dark:bg-gray-950 bg-white dark:text-white text text-black font-sans">



    <livewire:pages.dashboard />

    <script src="./assets/vendor/lodash/lodash.min.js"></script>
<script src="./assets/vendor/vanilla-calendar-pro/index.js"></script>
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <script>
        
    </script>

    <script>
        const btn = document.getElementById('menu-btn');
        const sidebar = document.querySelector('aside.sidebar');

        btn.addEventListener('click', () => {
            const expanded = btn.getAttribute('aria-expanded') === 'true' || false;
            btn.setAttribute('aria-expanded', !expanded);
            sidebar.classList.toggle('-translate-x-full');
        });

        // Optional: Close sidebar on navigation for small screens
        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('-translate-x-full');
                    btn.setAttribute('aria-expanded', false);
                }
            });
        });
    </script>

    <script>
        // Fungsi untuk animasi penghitungan
        function animateCount(element, start, end, duration) {
            // console.log(`animateCount called: start=${start}, end=${end}, element=${element.outerHTML}`); // Untuk debugging
            let current = start;
            const range = end - start;
            let startTime = null;

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                const progress = timestamp - startTime;

                if (progress < duration) {
                    current = start + (range * (progress / duration));
                    element.textContent = 'Rp ' + Math.round(current).toLocaleString('id-ID');
                    requestAnimationFrame(step); // Ini yang penting: menggunakan requestAnimationFrame
                } else {
                    element.textContent = 'Rp ' + end.toLocaleString('id-ID'); // Pastikan nilai akhir tepat
                }
            }
            requestAnimationFrame(step); // Memulai animasi dengan requestAnimationFrame
        }

        // ... (sisa kode JavaScript Anda di dalam document.addEventListener('livewire:load', function () { ... })) ...
    </script>
    {{-- <script>
        // Fungsi untuk animasi penghitungan
        function animateCount(element, start, end, duration) {
            let current = start;
            const range = end - start;
            const increment = end > start ? (end - start) / (duration / 10) : (end - start) / (duration / 10); // Calculate increment based on duration

            let startTime = null;

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                const progress = timestamp - startTime;

                if (progress < duration) {
                    current = start + (range * (progress / duration));
                    element.textContent = 'Rp ' + Math.round(current).toLocaleString('id-ID'); // Format dan bulatkan
                    requestAnimationFrame(step);
                } else {
                    element.textContent = 'Rp ' + end.toLocaleString('id-ID'); // Pastikan nilai akhir tepat
                }
            }

            requestAnimationFrame(step);
        }


        document.addEventListener('livewire:load', function () {
            // Fungsi untuk menerapkan animasi ke satu elemen
            function applyAnimationToElement(element, startFromZero = false) {
                if (element.hasAttribute('data-animated')) {
                    const targetValue = parseFloat(element.getAttribute('data-value'));
                    const currentText = element.textContent.replace(/[^0-9,-]+/g, "").replace(/\./g, "").replace(",", ".");
                    const startValue = isNaN(parseFloat(currentText)) ? 0 : parseFloat(currentText);

                    // Animate dari 0 jika startFromZero true (untuk refresh page atau pertama kali show)
                    // Atau jika nilai target berbeda dari nilai yang saat ini terlihat (untuk update data)
                    if (startFromZero || startValue !== targetValue) {
                        // Pastikan elemen terlihat sebelum menganimasi
                        if (element.offsetParent !== null) { // Check if element is visible
                            animateCount(element, startFromZero ? 0 : startValue, targetValue, 1000); // 1000ms duration
                        }
                    }
                }
            }

            // 1. Animasi saat REFRESH HALAMAN (initial load)
            // Hanya elemen yang secara default terlihat (show: true atau show:false namun sudah di-show)
            document.querySelectorAll('[data-animated]').forEach(el => {
                // Periksa apakah parent Alpine.js-nya menunjukkan elemen ini
                // Ini sedikit tricky karena Alpine.js belum tentu fully initialized saat livewire:load
                // Cara paling aman adalah asumsikan elemen yang data-animated dan tidak tersembunyi
                // secara "initial" akan dianimasikan
                 if (el.offsetParent !== null) { // Check if element is visible on load
                    applyAnimationToElement(el, true); // Animate from 0 on initial load
                }
            });


            // 2. Animasi saat data diperbarui oleh Livewire (misalnya setelah add transaction)
            Livewire.hook('element.updated', (el, component) => {
                // Jika elemen yang diupdate adalah elemen data-animated itu sendiri
                if (el.hasAttribute('data-animated')) {
                    // Hanya animasikan jika elemen terlihat dan nilai targetnya beda dari awal
                    if (el.offsetParent !== null) {
                        applyAnimationToElement(el, false); // Animate dari nilai yang ada ke nilai baru
                    }
                }
                // Jika ada anak elemen dengan data-animated di dalam elemen yang diupdate
                el.querySelectorAll('[data-animated]').forEach(childEl => {
                    if (childEl.offsetParent !== null) {
                        applyAnimationToElement(childEl, false); // Animate dari nilai yang ada ke nilai baru
                    }
                });
            });


            // 3. Animasi ketika TOGGLE VISIBILITY menjadi 'Show'
            // Alpine.js memancarkan event ini ketika x-show menjadi true
            document.addEventListener('alpine:showing', (event) => {
                const targetElement = event.detail.el;
                if (targetElement.hasAttribute('data-animated')) {
                    applyAnimationToElement(targetElement, true); // Animate from 0 when becoming visible
                }
            });
        });
    </script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}




</body>

</html>
