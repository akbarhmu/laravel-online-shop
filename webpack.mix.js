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

mix.js('resources/js/admin/app.js', 'public/js/admin')
    .js('resources/js/user/app.js', 'public/js/user')
    .js('resources/js/admin/page/index.js', 'public/js/admin/page/index.js')
    .js('resources/js/admin/page/bootstrap-modal.js', 'public/js/admin/page/bootstrap-modal.js')
    .copy('node_modules/chart.js/dist/Chart.js', 'public/js/admin/modules/chart.js')
    .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/admin/modules/sweetalert.js')
    .sass('resources/sass/admin/app.scss', 'public/css/admin')
    .sass('resources/sass/user/app.scss', 'public/css/user')
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}

