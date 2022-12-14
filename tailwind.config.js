/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors') 
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    './vendor/wireui/wireui/resources/**/*.blade.php',
    './vendor/wireui/wireui/ts/**/*.ts',
    './vendor/wireui/wireui/src/View/**/*.php',
    './vendor/filament/**/*.blade.php',
  ],
  presets: [
    require('./vendor/wireui/wireui/tailwind.config.js')
  ],
  theme: {
    extend: {
      colors: {
        danger: colors.rose,
        secondary: colors.neutral,
        gray: colors.neutral,
        primary: colors.blue,
        success: colors.green,
        warning: colors.yellow,
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
