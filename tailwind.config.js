/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: 'jit',
  content: [
    "./assets/**/*.js",
    "./classes/*.{html,php}",
    "./views/*.{html,php}"
  ],
  plugins: [],
  theme: {
    extend: {},
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      'st-dk-blue': "#2D5591",
      'st-lt-blue': "#0da2e4",
      'st-white': "#ffffff",
      'st-lt-gray': "#DDDDDD",
      'st-bg-gray': "#f8f8f8",
      'st-dk-gray': "#667388",
    },
  },
}
