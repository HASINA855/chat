import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/js/loadDiscution.js', 'resources/js/app.js','resources/js/message.js','resources/js/listeDiscution.js','resources/js/inscription.js'],
            refresh: true,
        }),
    ],
});
