const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
  prefix: 'tw-',

  darkMode: 'class',

  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/frontend/**/*.vue',
    './resources/prontostack/pronto-ui/**/*.vue'
  ],

  theme: {
    extend: {
      colors: {
        primary: colors.violet,
        accent: colors.fuchsia,
        success: colors.green,
        info: colors.blue,
        warning: colors.amber,
        danger: colors.red,
        default: colors.slate
      },
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans]
      }
    }
  },

  plugins: []
}
