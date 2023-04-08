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
        "application-all": "#f1f7fc",
      },
    },
  },
  plugins: [],
};
