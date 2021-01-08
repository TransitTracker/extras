const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['Roboto', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        primary: {
          100: '#f2f8fc',
          200: '#b7d9f0',
          300: '#7cbae4',
          400: '#419bd8',
          500: '#2373a9',
          600: '#1d5f8c',
          700: '#16486a',
          800: '#10344c',
          900: '#091d2a'
        },
        secondary: {
          100: '#f3fcfb',
          200: '#cbf0ec',
          300: '#a0e4dc',
          400: '#78d8cd',
          500: '#4dccbd',
          600: '#32aea0',
          700: '#258378',
          800: '#18534c',
          900: '#0b2824'
        },
        stm: {
          green: '#3b9b74',
          yellow: '#f7e200',
          blue: '#00aeef',
        },
        felixinx: {
          'blue-300': '#566877',
          'blue-500': '#0e273c',
          'green-400': '#70B68E',
          'green-500': '#32965d',
          orange: '#d65108',
          yellow: '#efa00b',
        },
      },
      height: (theme) => ({
        'half': '50vh',
        '(screen-16)':  `calc(100vh - ${theme('spacing.16')})`,
      }),
      width: {
        half: '50%',
      },
    },
    inset: {
      0: 0,
      3: '0.75rem',
      8: '2rem',
      16: '4rem',
      20: '5rem',
      24: '6rem',
      32: '8rem',
    },
    maxHeight: (theme) => ({
      'full': '100%',
      '40-screen': '40vh',
      '(screen-32)':  `calc(100vh - ${theme('spacing.32')})`,
    }),
  },
  variants: {
    borderWidth: ['last'],
    opacity: ['group-hover'],
  },
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
