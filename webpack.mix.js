const mix = require('laravel-mix');
const webpack = require('webpack');
require('dotenv').config();

const THEME_NAME = process.env.THEME_NAME || 'limaeditores';
const PROXY = process.env.PROXY || 'local.limaeditores.com';
const THEME_DIRECTORY = `wp-content/themes/${THEME_NAME}`;
const ASSETS_DIR = `${THEME_DIRECTORY}/assets`;
const BUILD_DIR = `${ASSETS_DIR}/build`;
const BUILD_MESSAGE = `Compilando tema: ${THEME_NAME}`;

mix
  .webpackConfig({
    devtool: 'source-map',
    output: {
      chunkFilename: 'chunks/[name].js',
    },
    stats: {
      children: true,
    },
    watchOptions: {
      ignored: /build/,
    },
    plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
      }),
    ],
  })
  .setPublicPath(BUILD_DIR)
  .js(`${ASSETS_DIR}/js/main.js`, BUILD_DIR)
  .sass(`${ASSETS_DIR}/scss/style.scss`, BUILD_DIR)
  .options({
    processCssUrls: false,
    postCss: [require('@tailwindcss/postcss'), require('autoprefixer')],
  })
  .sourceMaps(true, 'source-map');

if (PROXY) {
  mix.browserSync({
    proxy: PROXY,
    open: false,
    files: [
      `${BUILD_DIR}/**/*.css`,
      `${BUILD_DIR}/**/*.js`,
      `${THEME_DIRECTORY}/**/*.php`,
    ],
    notify: {
      styles: {
        top: 'auto',
        bottom: '0',
      },
    },
  });
}

if (mix.inProduction()) {
  console.log(BUILD_MESSAGE);
  mix
    .minify([
      `${BUILD_DIR}/style.css`,
      `${BUILD_DIR}/main.js`,
    ])
    .version([]);
}
