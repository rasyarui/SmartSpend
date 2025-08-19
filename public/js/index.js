document.addEventListener("livewire:initialized", () => {
    const datepickerEl = document.getElementById("datepicker-actions");

    datepickerEl.addEventListener("changeDate", (event) => {
        const selectedDate = event.detail.date;

        // Format tanggal menjadi string "YYYY-MM-DD"
        const formattedDate = new Date(
            selectedDate.getTime() - selectedDate.getTimezoneOffset() * 60000
        )
            .toISOString()
            .split("T")[0];

        if (window.Livewire) {
            window.Livewire.find(
                datepickerEl.closest("[wire\\:id]").getAttribute("wire:id")
            ).set("transaction_date", formattedDate);
        }
    });
});

function animateCount(element, start, end, duration) {
    // console.log(`animateCount called: start=${start}, end=${end}, element=${element.outerHTML}`); // Untuk debugging
    let current = start;
    const range = end - start;
    let startTime = null;

    function step(timestamp) {
        if (!startTime) startTime = timestamp;
        const progress = timestamp - startTime;

        if (progress < duration) {
            current = start + range * (progress / duration);
            element.textContent =
                "Rp " + Math.round(current).toLocaleString("id-ID");
            requestAnimationFrame(step); // Ini yang penting: menggunakan requestAnimationFrame
        } else {
            element.textContent = "Rp " + end.toLocaleString("id-ID"); // Pastikan nilai akhir tepat
        }
    }
    requestAnimationFrame(step); // Memulai animasi dengan requestAnimationFrame
}

const btn = document.getElementById("menu-btn");
const sidebar = document.querySelector("aside.sidebar");

const closeSidebar = () => {
    sidebar.classList.add("-translate-x-full");
    btn.setAttribute("aria-expanded", false);
};

btn.addEventListener("click", () => {
    const expanded = btn.getAttribute("aria-expanded") === "true" || false;
    btn.setAttribute("aria-expanded", !expanded);
    sidebar.classList.toggle("-translate-x-full");
    sidebar.classList.toggle("-translate-x-full");
    sidebar.classList.toggle("translate-x-0"); 
});

document.addEventListener("click", (event) => {
    // Periksa apakah klik berada di luar sidebar DAN di luar tombol menu
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnMenuButton = btn.contains(event.target);

    // Jika sidebar terbuka dan klik berada di luar kedua elemen tersebut, tutup sidebar
    if (
        sidebar.classList.contains("translate-x-0") &&
        !isClickInsideSidebar &&
        !isClickOnMenuButton
    ) {
        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0");
        btn.setAttribute("aria-expanded", false);
    }
});
// Optional: Close sidebar on navigation for small screens
sidebar.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
        if (window.innerWidth < 768) {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
            btn.setAttribute("aria-expanded", false);
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.getElementById("dropdown-button");
    const dropdownMenu = document.getElementById("dropdown-menu");

    // Fungsi untuk menampilkan/menyembunyikan dropdown
    function toggleDropdown() {
        dropdownMenu.classList.toggle("hidden");
    }

    // Menangani klik pada tombol dropdown
    dropdownButton.addEventListener("click", function (event) {
        event.stopPropagation(); // Mencegah event menyebar ke dokumen
        toggleDropdown();
    });

    // Menangani klik di luar dropdown untuk menyembunyikannya
    document.addEventListener("click", function (event) {
        // Cek apakah target klik berada di luar dropdown atau tombol
        if (
            !dropdownMenu.contains(event.target) &&
            !dropdownButton.contains(event.target)
        ) {
            if (!dropdownMenu.classList.contains("hidden")) {
                toggleDropdown();
            }
        }
    });
});
