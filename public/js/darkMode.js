document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement;
    const modeMenuButton = document.getElementById("mode-menu-button");
    const modeMenu = document.getElementById("mode-menu");
    const backgroundSlider = document.getElementById("background-slider"); // Ambil elemen background slider
    const themeLabelElement = document.getElementById("theme-label");


    // Dapatkan referensi ke setiap ikon SVG
    const iconLight = document.getElementById("icon-light");
    const iconDark = document.getElementById("icon-dark");
    const iconSystem = document.getElementById("icon-system");

    // Fungsi untuk mendapatkan preferensi mode sistem (OS)
    const getSystemPreference = () => {
        return window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
    };

    const updateThemeLabel = () => {
    const savedMode = localStorage.getItem("themeMode");
    let label = "System Mode"; // default

    if (savedMode === "light") {
        label = "Light Mode";
    } else if (savedMode === "dark") {
        label = "Dark Mode";
    } else if (!savedMode) {
        // Mode system — cek preferensi OS
        const systemPref = window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "Dark Mode"
            : "Light Mode";
        label = `System Mode (${systemPref})`; // Opsional: tunjukkan hasil aktual
    }

    if (themeLabelElement) {
        themeLabelElement.textContent = label;
    }
};

    // Fungsi untuk menyembunyikan semua ikon
    const hideAllIcons = () => {
        if (iconLight) iconLight.classList.add("hidden");
        if (iconDark) iconDark.classList.add("hidden");
        if (iconSystem) iconSystem.classList.add("hidden");
    };

    // Fungsi untuk menerapkan mode ke elemen html dan localStorage
    const applyMode = (mode) => {
        hideAllIcons(); // Sembunyikan semua ikon terlebih dahulu

        if (mode === "dark") {
            html.classList.add("dark");
            localStorage.setItem("themeMode", "dark");
            if (iconDark) iconDark.classList.remove("hidden");
            // backgroundSlider.style.transform = `translateX(100%)`;
            // Tampilkan ikon gelap
        } else if (mode === "light") {
            html.classList.remove("dark");
            localStorage.setItem("themeMode", "light");
            if (iconLight) iconLight.classList.remove("hidden"); // Tampilkan ikon terang
            // backgroundSlider.style.transform = `translateX(0)`;
        } else if (mode === "system") {
            const systemPref = getSystemPreference();
            if (systemPref === "dark") {
                html.classList.add("dark");
                if (iconDark) iconDark.classList.remove("hidden"); // Tampilkan ikon gelap (karena sistem gelap)
                // backgroundSlider.style.transform = `translateX(-100%)`;
            } else {
                html.classList.remove("dark");
                if (iconLight) iconLight.classList.remove("hidden"); // Tampilkan ikon terang (karena sistem terang)
                // backgroundSlider.style.transform = `translateX(0)`;
            }
            localStorage.removeItem("themeMode"); 
        }
        updateThemeLabel();
    };

    // Inisialisasi mode saat halaman dimuat
    const savedMode = localStorage.getItem("themeMode");
    if (savedMode) {
        applyMode(savedMode);
    } else {
        applyMode("system"); // Default ke 'system' jika tidak ada preferensi tersimpan
    }
    updateThemeLabel();


    window
        .matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", (e) => {
            if (localStorage.getItem("themeMode") === null) {
                // Jika tidak ada mode tersimpan (artinya 'system' aktif)
                applyMode("system"); // Panggil ulang applyMode untuk memperbarui ikon dan kelas
            }
        });

    // Toggle dropdown (pastikan elemen ditemukan sebelum menambahkan listener)
    if (modeMenuButton) {
        modeMenuButton.addEventListener("click", () => {
            modeMenu.classList.toggle("hidden");
        });
    }

    // Sembunyikan dropdown ketika klik di luar
    document.addEventListener("click", (event) => {
        if (
            modeMenuButton &&
            modeMenu &&
            !modeMenuButton.contains(event.target) &&
            !modeMenu.contains(event.target)
        ) {
            modeMenu.classList.add("hidden");
        }
    });

    // Event listener untuk setiap pilihan mode di dropdown
    const modeOptions = document.querySelectorAll("[data-mode-option]");
    modeOptions.forEach((option) => {
        option.addEventListener("click", (e) => {
            e.preventDefault();
            const selectedMode = option.getAttribute("data-mode-option");
            applyMode(selectedMode);
            modeMenu.classList.add("hidden");
        });
    });
});

// Dapatkan elemen yang akan menampilkan status tema
const themeStatusElement = document.getElementById("theme-status");

// Fungsi untuk memperbarui teks status tema
const updateThemeStatus = () => {
    // Cek apakah elemen html memiliki kelas 'dark'
    const isDarkMode = document.documentElement.classList.contains("dark");

    if (isDarkMode) {
        themeStatusElement.textContent = "Dark theme active";
    } else {
        themeStatusElement.textContent = "Light theme active";
    }
};

// Panggil fungsi saat halaman dimuat untuk menetapkan status awal
updateThemeStatus();

// Buat MutationObserver untuk mendengarkan perubahan pada atribut 'class' di elemen <html>
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.attributeName === "class") {
            // Jika atribut kelas berubah, perbarui status tema
            updateThemeStatus();
        }
    });
});

// Konfigurasi observer untuk mendengarkan perubahan atribut
const observerConfig = { attributes: true };

// Mulai mendengarkan perubahan pada elemen <html>
observer.observe(document.documentElement, observerConfig);
