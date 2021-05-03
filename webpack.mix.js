const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/page/index.js', 'public/js/page/index.js')
    .copy('node_modules/chart.js/dist/chart.js', 'public/modules/chart.js')
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}

