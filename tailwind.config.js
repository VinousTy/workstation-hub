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
        "opacity-black": "rgba(0, 0, 0, 0.7)",
      },
    },
  },
  plugins: [],
};
