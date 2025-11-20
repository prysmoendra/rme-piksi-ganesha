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
                sans: ['Inter', 'system-ui', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    blue: '#3B82F6',
                },
                secondary: {
                    gray: '#6B7280',
                },
                background: {
                    main: '#FFFFFF',
                    sidebar: '#F9FAFB',
                },
                success: '#10B981',
                warning: '#F59E0B',
                error: '#EF4444',
                text: {
                    primary: '#111827',
                    secondary: '#6B7280',
                },
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
            },
            borderRadius: {
                'custom': '6px',
            },
            boxShadow: {
                'sm-custom': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
            },
        },
    },

    plugins: [forms],
};
