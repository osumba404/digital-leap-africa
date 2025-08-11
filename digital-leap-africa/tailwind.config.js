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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Add your custom color palette here
            colors: {
                'primary': '#020b13',
                'primary-light': '#020b12',
                'secondary': '#2e67b2',
                'secondary-dark': '#28579b',
                'accent': '#4489d2',
                'white': '#ffffff',
            }
        },
    },

    plugins: [forms],
};