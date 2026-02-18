import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    cacheDir: '/tmp/.vite_cache',
    server: {
        host: '0.0.0.0', // Позволяет подключаться извне контейнера
        hmr: {
            host: 'localhost', // Хост для Hot Module Replacement в браузере
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue(),

    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    },
    css: {
    preprocessorOptions: {
      scss: {
        // 1. Используем современный API компилятора
        api: 'modern-compiler',
        // 2. Игнорируем ворнинги о функциях цвета и зависимостях
        silenceDeprecations: ['color-functions', 'global-builtin', 'import'],
        quietDeps: true,
      },
    },
  },
});
