import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: { DEFAULT: '#3B1F6B', light: '#6B3FA0', muted: '#D4BBF0' },
                accent: { DEFAULT: '#E87722', light: '#FFF3E8' },
                surface: { DEFAULT: '#FAF8FF', card: '#F3EEF9' }
            },
            fontFamily: {
                sans: ['"DM Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono]
            },
        },
    },

    plugins: [forms],
};
