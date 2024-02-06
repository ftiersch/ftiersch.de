/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/views/new/**/*.blade.php",
      "./resources/js/new/**/*.js",
      "./resources/js/new/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
            brand: '#FF9000',
            contrary: '#233142',
        },
        fontFamily: {
            sans: ['"Space Mono"', 'Arial', 'serif'],
            kaushan: ['"Kaushan Script"', "cursive"],
            icomoon: ["Icomoon", "sans-serif"],
        },
        backgroundImage: {
            'loader': "url('../../images/loader.gif')",
        },
        height: {
            '600': '600px',
        }
    },
  },
  plugins: [],
}

