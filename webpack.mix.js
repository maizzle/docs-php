let mix = require('laravel-mix');
let tailwind = require('tailwindcss');
let build = require('./tasks/js/build.js');
require('laravel-mix-purgecss');

mix.disableNotifications()
mix.setPublicPath('source/assets/')
mix.webpackConfig({
  plugins: [
    build.jigsaw,
    build.browserSync(),
    build.watch(['source/**/*.md', '*.php', 'source/_assets/**/*.css', '!source/**/_tmp/*', '!source/assets/**/*']),
  ]
});

mix.options({
    processCssUrls: false,
    postCss: [
      require('postcss-import'),
      require('postcss-nested'),
      tailwind('tailwind.js'),
    ]
  })
  .postCss('source/_assets/css/app.css', 'css')
  .purgeCss({
    folders: ['source'],
    extensions: ['html', 'md', 'php', 'vue', 'svg'],
    whitelistPatterns: [/dropdown/, /pre/, /code/, /copy/, /a(lgoli)?a/, /w-3\/5/]
  })
  .js('source/_assets/js/app.js', 'js/')
  .version()

