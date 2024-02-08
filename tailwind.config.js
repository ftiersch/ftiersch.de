/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/views/**/*.blade.php",
      "./resources/js/**/*.js",
      "./resources/js/**/*.vue",
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

