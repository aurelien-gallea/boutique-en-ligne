/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/index.html",
    "./assets/js/*.js",
    "./assets/js/**/*.js",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

