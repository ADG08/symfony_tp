/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/react/**/*.jsx",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors:{
        "midnight-gray": "#0e1113",
        "slate-gray": "#3e4042",
      }
    },
  },
  plugins: [],
}

