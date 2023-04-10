/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.tsx",
  ],
  theme: {
    extend: {
      colors: {
        "application-all": "#0d1117",
        "header-color": "#404048",
        "opacity-black": "rgba(30, 30, 30, 0.9)",
      },
    },
  },
  plugins: [],
};
