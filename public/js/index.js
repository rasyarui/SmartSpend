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

const sidebar = document.getElementById("sidebar2");
const sidebarOpenBtn = document.getElementById("sidebar-open-btn");
const overlay = document.getElementById("overlay");
const closeSidebar = () => {
    sidebar.classList.remove("translate-x-0");
    sidebar.classList.add("-translate-x-full");
    overlay.classList.add("hidden");
};
const openSidebar = () => {
    sidebar.classList.remove("-translate-x-full");
    sidebar.classList.add("translate-x-0");
    overlay.classList.remove("hidden");
};

// Register JS
