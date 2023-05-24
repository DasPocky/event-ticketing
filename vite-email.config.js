import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        rollupOptions: {
            output: {
                assetFileNames: 'assets/[name].[ext]'
            }
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/mail.css',
            ],
            refresh: true,
        }),
    ],
});
