/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './template-valentine.php',
    './template-valentine-yes.php',
    './*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'valentine-red': '#e11d48',
        'valentine-pink': '#fb7185',
        'valentine-rose': '#fda4af',
        'soft-yellow': '#fef3c7',
      },
      animation: {
        'float': 'float 3s ease-in-out infinite',
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        'bounce-slow': 'bounce 2s infinite',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0) rotate(0deg)' },
          '50%': { transform: 'translateY(-20px) rotate(2deg)' },
        },
      },
    },
  },
  plugins: [],
};
