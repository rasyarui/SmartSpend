// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // Import plugin Tailwind CSS v4

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss({
            // Ini adalah tempat Anda mengkonfigurasi Tailwind CSS v4
            // Tidak ada lagi tailwind.config.js terpisah
            content: [
                './resources/**/*.blade.php',
                './resources/**/*.js',
                './resources/**/*.vue',
            ],
            // Anda bisa menambahkan 'theme', 'plugins', dll. langsung di sini
            // theme: {
            //   extend: {
            //     colors: {
            //       'custom-blue': '#1a2b3c',
            //     }
            //   }
            // },
        }),
    ],
});