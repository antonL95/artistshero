import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [require('./vendor/tallstackui/tallstackui/tailwind.config.js')],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/tallstackui/tallstackui/src/**/*.php',
    ],

    theme: {
        colors: {
            black: '#000000',
            white: '#ffffff',
            gray: '#F2F2F2',
            'gray-60': '#666666',
            'gray-80': '#B3B3B3',
        },
        container: {
            padding: {
                DEFAULT: '1rem',
                sm: '1rem',
            },
        },
        fontFamily: {
            roboto: ['Roboto', 'sans-serif'],
            urbanist: ['"Urbanist"', 'sans-serif'],
        },
        keyframes: {
            topToBottom: {
                '0%': { opacity: '0' },
                '5%': { transform: 'translateY(-10px)', opacity: '0' },
                '10%': { transform: 'translateY(0px)', opacity: '1' },
                '25%': { transform: 'translateY(0px)', opacity: '1' },
                '30%': { transform: 'translateY(+10px)', opacity: '0' },
                '80%': { opacity: '0' },
                '100%': { opacity: '0' },
            },
            spin: {
                from: { transform: 'rotate(0deg)' },
                to: { transform: 'rotate(360deg)' },
            },
        },
        extend: {
            animation: {
                topToBottom: 'topToBottom 15s linear 0s infinite',
                spin: 'spin 1s linear infinite',
            },
        },
    },

    plugins: [forms, typography],
};
