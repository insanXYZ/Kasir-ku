/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,jsx,tsx}",
  ],
  theme: {
    extend: {
      screens: {
        'print' : {'raw' : 'print'}
      },
      colors: {
        "Abu" : "#707487",
        "Bungur" : "#605ea6"
      },
      fontFamily:{
        "work" : "work",
        "work-b" : "work-b"
      }
    },
  },
  plugins: [],
}

