// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite"; // Import plugin Tailwind CSS v4

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss({
            // Ini adalah tempat Anda mengkonfigurasi Tailwind CSS v4
            // Tidak ada lagi tailwind.config.js terpisah
            content: [
                "./resources/**/*.blade.php",
                "./resources/**/*.js",
                "./resources/**/*.vue",
            ],

            // theme: {
            //     extend: {
            //         colors: {
            //             background:
            //                 "linear-gradient(135deg, #fafbff 0%, #f1f4f9 30%, #e8f2ff 70%, #dbeafe 100%)",
            //             muted: "rgba(100, 116, 139, 0.08)",
            //             "muted-foreground": "#475569",
            //         },
            //     },
            // },
        }),
    ],
});
