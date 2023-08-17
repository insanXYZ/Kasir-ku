/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/**/*.blade.php",
  ],
  theme: {  
    extend: {
      colors:{
        'orange':'#e96629'
      },
      screens:{
        'mobile': {'raw': '(max-width:900px)'}
      }
    },
  },
  plugins: [],
}

