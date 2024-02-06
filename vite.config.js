import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/old/app.scss',
                'resources/js/old/app.js'
            ],
            refresh: true,
        }),
    ],
});
