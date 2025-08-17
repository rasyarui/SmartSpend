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

btn.addEventListener("click", () => {
    const expanded = btn.getAttribute("aria-expanded") === "true" || false;
    btn.setAttribute("aria-expanded", !expanded);
    sidebar.classList.toggle("-translate-x-full");
});

// Optional: Close sidebar on navigation for small screens
sidebar.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
        if (window.innerWidth < 768) {
            sidebar.classList.add("-translate-x-full");
            btn.setAttribute("aria-expanded", false);
        }
    });
});

