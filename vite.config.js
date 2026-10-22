import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.tsx',
            refresh: true,
        }),
        react(),
        tailwindcss(),
    ],
    build: {
        target: 'es2020',
        cssCodeSplit: true,
        minify: 'esbuild',
        rollupOptions: {},
        chunkSizeWarningLimit: 1200,
    },
});
