import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        { pattern: /^(bg|text|border|from|to|via|ring|shadow)-(slate|indigo|violet|emerald|amber|white)(-\d+)?$/ },
        { pattern: /^hover:(bg|text|border|from|to)-(slate|indigo|violet)-\d+$/ },
        'lg:grid-cols-2',
        'lg:flex',
        'lg:hidden',
        'backdrop-blur-lg',
        'bg-clip-text',
        'text-transparent',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#eef2ff',
                    100: '#e0e7ff',
                    500: '#6366f1',
                    600: '#4f46e5',
                    700: '#4338ca',
                },
            },
            boxShadow: {
                'ep': '0 4px 24px -4px rgba(79, 70, 229, 0.25)',
                'ep-lg': '0 12px 40px -8px rgba(79, 70, 229, 0.35)',
            },
        },
    },

    plugins: [forms],
};
