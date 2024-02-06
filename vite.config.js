import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/new/app.css',
                'resources/js/new/app.js'
            ],
            refresh: true,
        }),
    ],
});
