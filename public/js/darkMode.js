document.addEventListener("DOMContentLoaded", () => {
    const html = document.documentElement;
    const modeMenuButton = document.getElementById("mode-menu-button");
    const modeMenu = document.getElementById("mode-menu");
    const backgroundSlider = document.getElementById("background-slider");

    const iconLight = document.getElementById("icon-light");
    const iconDark = document.getElementById("icon-dark");
    const iconSystem = document.getElementById("icon-system");

    const getSystemPreference = () => {
        return window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
    };

    const hideAllIcons = () => {
        if (iconLight) iconLight.classList.add("hidden");
        if (iconDark) iconDark.classList.add("hidden");
        if (iconSystem) iconSystem.classList.add("hidden");
    };

    // Fungsi utama yang menerapkan mode, animasi, dan menyimpan ke localStorage
    const applyMode = (mode) => {
        hideAllIcons();

        // Tentukan mode akhir
        let finalMode = mode;
        if (mode === "system") {
            finalMode = getSystemPreference();
            localStorage.removeItem("themeMode");
        } else {
            localStorage.setItem("themeMode", mode);
        }

        // Terapkan kelas CSS
        if (finalMode === "dark") {
            html.classList.add("dark");
            if (iconDark) iconDark.classList.remove("hidden");
            if (backgroundSlider) backgroundSlider.style.transform = `translateX(-100%)`;
        } else {
            html.classList.remove("dark");
            if (iconLight) iconLight.classList.remove("hidden");
            if (backgroundSlider) backgroundSlider.style.transform = `translateX(0)`;
        }
    };

    // PENTING: Inisialisasi mode saat halaman pertama dimuat
    const savedMode = localStorage.getItem("themeMode");
    if (savedMode) {
        applyMode(savedMode);
    } else {
        applyMode("system");
    }

    // PENTING: Livewire Hook untuk menerapkan kembali mode setelah DOM diperbarui
    Livewire.hook('commit.succeeded', () => {
        const currentMode = localStorage.getItem("themeMode");
        if (currentMode) {
            applyMode(currentMode);
        } else {
            applyMode("system");
        }
    });

    // Event listener untuk preferensi sistem berubah
    window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", (e) => {
        if (localStorage.getItem("themeMode") === null) {
            applyMode("system");
        }
    });

    // Toggle dropdown
    if (modeMenuButton) {
        modeMenuButton.addEventListener("click", () => {
            modeMenu.classList.toggle("hidden");
        });
    }

    // Sembunyikan dropdown ketika klik di luar
    document.addEventListener("click", (event) => {
        if (modeMenuButton && modeMenu && !modeMenuButton.contains(event.target) && !modeMenu.contains(event.target)) {
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