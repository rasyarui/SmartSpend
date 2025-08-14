import './bootstrap';
import 'preline'



// resources/js/app.js

import './bootstrap'; // Jika ada, biarkan saja
import '../css/app.css'; // Penting: Impor CSS utama Anda




// document.addEventListener('DOMContentLoaded', () => {
//     const html = document.documentElement; // Mengacu pada elemen <html>
//     const modeMenuButton = document.getElementById('mode-menu-button');
//     const modeMenu = document.getElementById('mode-menu');
//     const modeLight = document.getElementById('mode-light');
//     const modeDark = document.getElementById('mode-dark');
//     const modeSystem = document.getElementById('mode-system');
    

//     // Fungsi untuk mendapatkan preferensi mode sistem (OS)
//     const getSystemPreference = () => {
//         return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
//     };

//     // Fungsi untuk menerapkan mode ke elemen html dan localStorage
//     const applyMode = (mode) => {
//         if (mode === 'dark') {
//             html.classList.add('dark');
//             localStorage.setItem('themeMode', 'dark');
//         } else if (mode === 'light') {
//             html.classList.remove('dark');
//             localStorage.setItem('themeMode', 'light');
//         } else if (mode === 'system') {
//             const systemPref = getSystemPreference();
//             if (systemPref === 'dark') {
//                 html.classList.add('dark');
//             } else {
//                 html.classList.remove('dark');
//             }
//             localStorage.removeItem('themeMode'); // Hapus dari local storage jika system
//         }
//     };

//     // Inisialisasi mode saat halaman dimuat
//     const savedMode = localStorage.getItem('themeMode');
//     if (savedMode) {
//         applyMode(savedMode); // Terapkan mode yang tersimpan
//     } else {
//         // Default ke 'light' jika tidak ada preferensi tersimpan
//         // Atau ubah ke 'system' jika Anda ingin default ke preferensi OS
//         applyMode('light');
//     }

//     // Event listener untuk preferensi sistem berubah (saat mode 'system' aktif)
//     window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
//         // Hanya terapkan ulang system mode jika mode yang dipilih saat ini adalah 'system'
//         if (localStorage.getItem('themeMode') === null) { // Jika tidak ada mode tersimpan (artinya 'system' aktif)
//             applyMode('system');
//         }
//     });

//     // Toggle dropdown (pastikan elemen ditemukan sebelum menambahkan listener)
//     if (modeMenuButton) {
//         modeMenuButton.addEventListener('click', () => {
//             modeMenu.classList.toggle('hidden');
//         });
//     }

//     // Sembunyikan dropdown ketika klik di luar
//     document.addEventListener('click', (event) => {
//         if (modeMenuButton && modeMenu && !modeMenuButton.contains(event.target) && !modeMenu.contains(event.target)) {
//             modeMenu.classList.add('hidden');
//         }
//     });

//     // Event listener untuk setiap pilihan mode di dropdown (pastikan elemen ditemukan)
//     // Menggunakan data-mode-option untuk mendapatkan nilai mode
//     const modeOptions = document.querySelectorAll('[data-mode-option]');
//     modeOptions.forEach(option => {
//         option.addEventListener('click', (e) => {
//             e.preventDefault(); // Mencegah navigasi default link
//             const selectedMode = option.getAttribute('data-mode-option');
//             applyMode(selectedMode);
//             modeMenu.classList.add('hidden');
//         });
//     });
// });
document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const modeMenuButton = document.getElementById('mode-menu-button');
    const modeMenu = document.getElementById('mode-menu');

    // Dapatkan referensi ke setiap ikon SVG
    const iconLight = document.getElementById('icon-light');
    const iconDark = document.getElementById('icon-dark');
    const iconSystem = document.getElementById('icon-system');

    // Fungsi untuk mendapatkan preferensi mode sistem (OS)
    const getSystemPreference = () => {
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    // Fungsi untuk menyembunyikan semua ikon
    const hideAllIcons = () => {
        if (iconLight) iconLight.classList.add('hidden');
        if (iconDark) iconDark.classList.add('hidden');
        if (iconSystem) iconSystem.classList.add('hidden');
    };

    // Fungsi untuk menerapkan mode ke elemen html dan localStorage
    const applyMode = (mode) => {
        hideAllIcons(); // Sembunyikan semua ikon terlebih dahulu

        if (mode === 'dark') {
            html.classList.add('dark');
            localStorage.setItem('themeMode', 'dark');
            if (iconDark) iconDark.classList.remove('hidden'); // Tampilkan ikon gelap
        } else if (mode === 'light') {
            html.classList.remove('dark');
            localStorage.setItem('themeMode', 'light');
            if (iconLight) iconLight.classList.remove('hidden'); // Tampilkan ikon terang
        } else if (mode === 'system') {
            const systemPref = getSystemPreference();
            if (systemPref === 'dark') {
                html.classList.add('dark');
                if (iconDark) iconDark.classList.remove('hidden'); // Tampilkan ikon gelap (karena sistem gelap)
            } else {
                html.classList.remove('dark');
                if (iconLight) iconLight.classList.remove('hidden'); // Tampilkan ikon terang (karena sistem terang)
            }
            localStorage.removeItem('themeMode'); // Hapus dari local storage jika system
            // Opsional: Jika Anda ingin ikon 'system' selalu tampil sebagai ikon komputer, tidak peduli preferensi OS:
            // if (iconSystem) iconSystem.classList.remove('hidden');
        }
    };

    // Inisialisasi mode saat halaman dimuat
    const savedMode = localStorage.getItem('themeMode');
    if (savedMode) {
        applyMode(savedMode);
    } else {
        applyMode('system'); // Default ke 'system' jika tidak ada preferensi tersimpan
    }

    // Event listener untuk preferensi sistem berubah (saat mode 'system' aktif)
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (localStorage.getItem('themeMode') === null) { // Jika tidak ada mode tersimpan (artinya 'system' aktif)
            applyMode('system'); // Panggil ulang applyMode untuk memperbarui ikon dan kelas
        }
    });

    // Toggle dropdown (pastikan elemen ditemukan sebelum menambahkan listener)
    if (modeMenuButton) {
        modeMenuButton.addEventListener('click', () => {
            modeMenu.classList.toggle('hidden');
        });
    }

    // Sembunyikan dropdown ketika klik di luar
    document.addEventListener('click', (event) => {
        if (modeMenuButton && modeMenu && !modeMenuButton.contains(event.target) && !modeMenu.contains(event.target)) {
            modeMenu.classList.add('hidden');
        }
    });

    // Event listener untuk setiap pilihan mode di dropdown
    const modeOptions = document.querySelectorAll('[data-mode-option]');
    modeOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedMode = option.getAttribute('data-mode-option');
            applyMode(selectedMode);
            modeMenu.classList.add('hidden');
        });
    });
});