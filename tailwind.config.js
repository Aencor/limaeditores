/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './wp-content/themes/limaeditores/**/*.php',
    './wp-content/themes/limaeditores/assets/js/**/*.js',
    './wp-content/themes/limaeditores/assets/scss/**/*.scss',
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          primary: '#74A626',      // Verde Lima Institucional
          'primary-hover': '#5E891C',
          accent: '#C4D626',       // Amarillo Lima / Páginas
          charcoal: '#3A3D40',     // Gris Editorial
          dark: '#1C2518',         // Verde Oscuro Institucional
          deep: '#141C11',         // Fondo Oscuro de Pie / Barras
          light: '#F8FAF3',        // Fondo Claro Sutil
          cream: '#F3F6EB',        // Acento Claro Suave
          muted: '#64748B',
        },
      },
      fontFamily: {
        serif: ['Merriweather', 'Georgia', 'serif'],
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
