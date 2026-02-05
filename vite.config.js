import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
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
