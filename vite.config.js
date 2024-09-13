import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Điều này cho phép Vite Dev Server lắng nghe từ tất cả các địa chỉ IP (bao gồm Docker)
        watch: {
            usePolling: true, // Cần thiết cho Docker để theo dõi thay đổi file
        },
        hmr: {
            host: 'localhost', // Bạn có thể điều chỉnh host nếu cần cho hot module reload (HMR)
        },
    }
});
