const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    "100": "#f2f8fc",
                    "200": "#b7d9f0",
                    "300": "#7cbae4",
                    "400": "#419bd8",
                    "500": "#2373a9",
                    "600": "#1d5f8c",
                    "700": "#16486a",
                    "800": "#10344c",
                    "900": "#091d2a"
                },
                secondary: {
                    "100": "#f3fcfb",
                    "200": "#cbf0ec",
                    "300": "#a0e4dc",
                    "400": "#78d8cd",
                    "500": "#4dccbd",
                    "600": "#32aea0",
                    "700": "#258378",
                    "800": "#18534c",
                    "900": "#0b2824"
                }
            },
        },
    },
    variants: {},
    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/typography'),
    ],
};
