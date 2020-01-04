module.exports = {
  theme: {
    extend: {}
  },
  variants: {
    textColor: ['responsive', 'hover', 'focus', 'group-hover'],
  },
  plugins: [
    require('@tailwindcss/custom-forms'),
  ]
}
