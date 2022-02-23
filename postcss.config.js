module.exports = {
  plugins: [
    require('postcss-import'),
    require('postcss-extend-rule'),
    require('tailwindcss/nesting')(require('postcss-nesting')),
    require('tailwindcss'),
    require('autoprefixer')
  ]
}
