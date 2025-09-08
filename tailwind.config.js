/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [ "./**/*.{html,php,js}",],
  theme: {
    extend: {
      fontFamily: {
        'SF Pro Display': ['SF Pro Display', 'sans-serif'],
        'SF Pro Display Bold': ['SF Pro Display Bold', 'sans-serif'],
      },
    },
  },
  plugins: [],
}