/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [ "./**/*.{html,php,js}",],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"DM Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif' ],
      },
    },
  },
  plugins: [],
}